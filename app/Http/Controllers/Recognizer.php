<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Car\Enter;
use App\Models\Gate;
use App\Services\Camera;
use App\Services\Recognition;
use App\Models\Request as Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Recognizer extends Controller
{
    /**
     * @var Recognition
     */
    private $recognizer;
    /**
     * @var Camera
     */
    private $camera;

    /**
     * @param Request $request
     *
     * @return array|string[]
     * @throws ValidationException
     */
    public function recognizeAction(Request $request)
    {
        $this->validate($request, ['gate_id' => 'integer|required']);

        $gate_id = $request->get('gate_id');
        $image   = $this->getImage($gate_id);
        $number  = $this->getNumber($image);

        $this->log();

        return $this->checkAvailabilityToCome(strtolower($number['plateNumber'])) ? ['success'] : ['error'];
    }

    /**
     * @param $image
     *
     * @return string[]
     */
    private function getNumber($image)
    {
        $this->recognizer = new Recognition();
        $this->recognizer->setImage($image);

        return $this->recognizer->getNumber();
    }

    /**
     * @param $gate_id
     *
     * @return string
     */
    private function getImage($gate_id)
    {
        $gate         = Gate::find($gate_id);
        $this->camera = new Camera($gate);

        return $this->camera->getImage();
    }

    private function log()
    {
        $request = new Log();
        $request->setGateId($this->camera->getGateId());
        $request->setResponseFromNrp($this->recognizer->getResponse());
        $request->setRequestImageUrl($this->camera->getImageAsString());
        $request->save();
    }

    public function checkAvailabilityToCome($number)
    {
        $car = Gate::find($this->camera->getGateId())->cars()
            ->where('plate_number', '=', strtolower($number))
            ->first();
        if (!is_null($car)) {
            if ($car->has_access === '1') {
                $this->logEntering($car->id, 1);

                return true;

            }
            $this->logEntering($car->id, 0);

            return false;
        } else {
            $carId = $this->createCar($number);
            $this->createCarGate($carId);
            $this->logEntering($carId, 0);
        }

        return false;
    }

    private function logEntering($carId, $hasEntered)
    {
        $enter = new Enter();
        $enter->setAttribute('car_id', $carId);
        $enter->setAttribute('gate_id', $this->camera->getGateId());
        $enter->setAttribute('has_entered', $hasEntered);
        $enter->save();
    }

    private function createCar($number)
    {
        $car = new Car();
        $car->setAttribute('plate_number', $number);
        $car->setAttribute('origin_gate_id', $this->camera->getGateId());
        $car->save();

        return $car->id;
    }

    private function createCarGate($carId)
    {
        DB::table('car_gate')->insert([
            'car_id'     => $carId,
            'gate_id'    => $this->camera->getGateId(),
            'has_access' => 0,
        ]);
    }
}
