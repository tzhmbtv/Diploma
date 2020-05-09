<?php

namespace App\Http\Controllers;

use App\Models\Car\Enter;
use App\Models\Gate;
use App\Services\Recognition;
use App\Services\RequestLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class Recognizer extends Controller
{
    public function recognizeAction(Request $request)
    {
        try {
            $hash  = $request->header('hash');
            $image = $request->file('car_image');

            $gate   = $this->getGateByClientHash($hash);
            $number = $this->getNumber($image->get());

            RequestLogger::logRequestToNpr($gate->id, $number, $image);

            if ($this->isAvailableToEnter($number['plateNumber'], $gate->id)) {
                return 'Success';
            }
        } catch (Exception $exception) {
            Log::error(print_r([
                'Message' => $exception->getMessage(),
                'Trace'   => $exception->getTraceAsString(),
            ], true));
        }

        return 'Error';
    }

    private function getNumber($image)
    {
        $recognizer = new Recognition();
        $recognizer->setImage($image);

        return $recognizer->getNumber();
    }

    public function isAvailableToEnter($number, int $gateId)
    {
        $car             = $this->findCarOrFail($gateId, $number);
        $hasAccessToGate = $car->has_access === 1;
        $this->logEnteringCarToGate($car->id, $car->has_access, $gateId);

        return $hasAccessToGate;
    }

    private function logEnteringCarToGate($carId, $hasEntered, $gateId)
    {
        $enter = new Enter();
        $enter->setAttribute('car_id', $carId);
        $enter->setAttribute('gate_id', $gateId);
        $enter->setAttribute('has_entered', $hasEntered);
        $enter->save();
    }

    /**
     * @param $gateId
     * @param $plateNumber
     *
     * @return Model
     * @throws Exception
     */
    private function findCarOrFail($gateId, $plateNumber)
    {
        $car = DB::table('cars')
            ->leftJoin('car_gate', 'cars.id', '=', 'car_gate.car_id')
            ->where('cars.plate_number', '=', $plateNumber)
            ->where('car_gate.gate_id', '=', $gateId)->first();

        if (!$car) {
            throw new Exception('Нет машины c таким номером и доступом к воротам');
        }

        return $car;
    }

    private function getGateByClientHash(string $hash): Gate
    {
        return Gate::query()->where('client_hash', '=', $hash)->firstOrFail();
    }
}
