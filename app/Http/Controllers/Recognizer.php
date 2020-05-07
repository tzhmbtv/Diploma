<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Car\Enter;
use App\Models\Gate;
use App\Services\Recognition;
use App\Services\RequestLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class Recognizer extends Controller
{
    public function recognizeAction(Request $request)
    {
        try {
            $hash  = $request->header('hash');
            $image = $request->get('car_image');

            $gate   = $this->getGateByClientHash($hash);
            $number = $this->getNumber($image);

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
        $car = $this->findCarOrCreate($gateId, $number);

        $hasAccessToGate = $car->has_access === '1';
        $this->logEnteringCarToGate($car->id, intval($car->has_access), $gateId);

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

    private function findCarOrCreate($gateId, $plateNumber)
    {
        $car = Gate::find($gateId)->cars()
            ->where('plate_number', '=', $plateNumber)->first();

        if (!$car) {
            $car = new Car();
            $car->setAttribute('plate_number', $plateNumber);
            $car->setAttribute('origin_gate_id', $gateId);
            $car->save();
        }

        return $car;
    }

    private function getGateByClientHash(string $hash): Gate
    {
        return Gate::query()->where('client_hash', '=', $hash)->firstOrFail();
    }
}
