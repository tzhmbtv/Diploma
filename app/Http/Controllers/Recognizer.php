<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Car\Enter;
use App\Models\Gate;
use App\Services\Camera;
use App\Services\Recognition;
use App\Services\RequestLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class Recognizer extends Controller
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function recognizeAction(Request $request)
    {
        $sensor_ip = $request->getClientIp();
        try {
            $gate   = $this->getGateBySensorIp($sensor_ip);
            $image  = $this->getImage($gate);
            $number = $this->getNumber($image);
            RequestLogger::logRequestToNpr($gate->id, $number, $image);

            return $this->isAvailableToEnter($number['plateNumber'], $gate->id);
        } catch (Exception $exception) {
            Log::error(print_r(['Message' => $exception->getMessage(), 'Trace' => $exception->getTraceAsString()]));

            return false;
        }
    }

    /**
     * @param $image
     *
     * @return string[]
     */
    private function getNumber($image)
    {
        $recognizer = new Recognition();
        $recognizer->setImage($image);

        return $recognizer->getNumber();
    }

    private function getImage(Gate $gate)
    {
        $camera = new Camera($gate);

        return $camera->getImage();
    }

    public function isAvailableToEnter($number, int $gateId)
    {
        $car = Gate::find($gateId)->cars()
            ->where('plate_number', '=', $number)
            ->firstOrNew(['plate_number', '=', $number]);

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

    private function getGateBySensorIp(string $sensor_ip): Gate
    {
        return Gate::query()->where('sensor_ip', '=', $sensor_ip)->firstOrFail();
    }
}
