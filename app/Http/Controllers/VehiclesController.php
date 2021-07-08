<?php

namespace App\Http\Controllers;

use App\DataTables\VehiclesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVehiclesRequest;
use App\Http\Requests\UpdateVehiclesRequest;
use App\Repositories\VehiclesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Str;

class VehiclesController extends AppBaseController
{
    /** @var  VehiclesRepository */
    private $vehiclesRepository;
    private $type = ['Jeep','Bus','Tricycle','Taxi','Van','Truck'];

    public function __construct(VehiclesRepository $vehiclesRepo)
    {
        $this->vehiclesRepository = $vehiclesRepo;
    }

    /**
     * Display a listing of the Vehicles.
     *
     * @param VehiclesDataTable $vehiclesDataTable
     * @return Response
     */
    public function index(VehiclesDataTable $vehiclesDataTable)
    {
        return $vehiclesDataTable->render('vehicles.index');
    }

    /**
     * Show the form for creating a new Vehicles.
     *
     * @return Response
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created Vehicles in storage.
     *
     * @param CreateVehiclesRequest $request
     *
     * @return Response
     */
    public function store(CreateVehiclesRequest $request)
    {
        $input = $request->all();
        
        //Add GUID 
        $input['guid'] = (string) Str::uuid();
        $input['type'] = $this->type[$request['type']];

        $vehicles = $this->vehiclesRepository->create($input);

        Flash::success('Vehicles saved successfully.');

        return redirect(route('vehicles.index'));
    }

    /**
     * Display the specified Vehicles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicles = $this->vehiclesRepository->find($id);

        if (empty($vehicles)) {
            Flash::error('Vehicles not found');

            return redirect(route('vehicles.index'));
        }

        return view('vehicles.show')->with('vehicles', $vehicles);
    }

    /**
     * Show the form for editing the specified Vehicles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicles = $this->vehiclesRepository->find($id);

        if (empty($vehicles)) {
            Flash::error('Vehicles not found');

            return redirect(route('vehicles.index'));
        }

        return view('vehicles.edit')->with('vehicles', $vehicles);
    }

    /**
     * Update the specified Vehicles in storage.
     *
     * @param  int              $id
     * @param UpdateVehiclesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehiclesRequest $request)
    {
        $vehicles = $this->vehiclesRepository->find($id);

        if (empty($vehicles)) {
            Flash::error('Vehicles not found');

            return redirect(route('vehicles.index'));
        }

        $request['type'] = $this->type[$request['type']];
        $vehicles = $this->vehiclesRepository->update($request->all(), $id);

        Flash::success('Vehicles updated successfully.');

        return redirect(route('vehicles.index'));
    }

    /**
     * Remove the specified Vehicles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicles = $this->vehiclesRepository->find($id);

        if (empty($vehicles)) {
            Flash::error('Vehicles not found');

            return redirect(route('vehicles.index'));
        }

        $this->vehiclesRepository->delete($id);

        Flash::success('Vehicles deleted successfully.');

        return redirect(route('vehicles.index'));
    }
}
