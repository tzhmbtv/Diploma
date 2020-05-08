<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Car\Enter;
use App\Models\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $cars = Car::latest()->paginate(5);

        return view('cars.index', compact('cars'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $gates = Gate::all();

        return view('cars/create', compact('gates', $gates));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required',
            'gates'        => 'required|array',
        ]);

        $request->offsetSet('client_hash', md5($request->get('client_hash')));

        $car = new Car();
        $car->setAttribute('plate_number', $request->get('plate_number'));
        $car->save();

        foreach ($request->get('gates') as $gate_id) {
            $car->gates()->attach($gate_id, ['has_access' => 1]);
        }

        return Redirect::to(route('cars.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id)
    {
        $car = Car::find($id);

        return view('cars.show')
            ->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit($id)
    {
        $car   = Car::find($id);
        $gates = Gate::all();
        $gates = $gates->merge($car->gates);
        $view  = view('cars.edit')->with('car', $car)->with('gates', $gates);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'plate_number' => 'required',
            'gates'        => 'required|array',
        ]);

        $car = Car::find($id);
        $car->setAttribute('plate_number', $request->get('plate_number'));
        $car->save();

        foreach ($request->get('gates') as $gate_id) {
            $car->gates()->attach($gate_id, ['has_access' => 1]);
        }

        $request->session()->flash('Successfully updated car!');

        return Redirect::to('cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    }
}
