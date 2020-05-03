<?php

namespace App\Http\Controllers;

use App\Models\Gate;
use App\Services\Camera;
use App\Services\Recognition;
use App\Models\Request as Log;
use Illuminate\Http\Request;
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

        return $number;
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
}
