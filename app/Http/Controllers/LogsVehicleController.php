<?php

namespace App\Http\Controllers;

use App\DataTables\LogsVehicleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLogsVehicleRequest;
use App\Http\Requests\UpdateLogsVehicleRequest;
use App\Repositories\LogsVehicleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Civilian;
use App\Models\Vehicles;

class LogsVehicleController extends AppBaseController
{
    /** @var  LogsVehicleRepository */
    private $logsVehicleRepository;

    public function __construct(LogsVehicleRepository $logsVehicleRepo)
    {
        $this->logsVehicleRepository = $logsVehicleRepo;
    }

    /**
     * Display a listing of the LogsVehicle.
     *
     * @param LogsVehicleDataTable $logsVehicleDataTable
     * @return Response
     */
    public function index(LogsVehicleDataTable $logsVehicleDataTable)
    {
        return $logsVehicleDataTable->render('logs_vehicles.index');
    }

    /**
     * Show the form for creating a new LogsVehicle.
     *
     * @return Response
     */
    public function create()
    {
        return view('logs_vehicles.create');
    }

    /**
     * Store a newly created LogsVehicle in storage.
     *
     * @param CreateLogsVehicleRequest $request
     *
     * @return Response
     */
    public function store(CreateLogsVehicleRequest $request)
    {
        $input = $request->all();

        //Parse host and user uuid to check type
        $user_p = substr($input['user_id'], 0, 1);
        $host_p = substr($input['host_id'], 0, 1);

        if($host_p != 'v' && $user_p != 'c') return abort(404);  

        $input['user_id'] = substr($input['user_id'], 2);
        $input['host_id'] = substr($input['host_id'], 2);
        
        $user = Civilian::where('guid', $input['user_id'])->first(); 
        $host = Vehicles::where('guid', $input['host_id'])->first(); 

        if(is_null($user) && is_null($host)) return abort(404); 

        $input['user_id'] = $user->id;
        $input['host_id'] = $host->id;
        
        $logsVehicle = $this->logsVehicleRepository->create($input);

        Flash::success('Logs Vehicle saved successfully.');

        return redirect(route('logsVehicles.index'));
    }

    /**
     * Display the specified LogsVehicle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            Flash::error('Logs Vehicle not found');

            return redirect(route('logsVehicles.index'));
        }

        return view('logs_vehicles.show')->with('logsVehicle', $logsVehicle);
    }

    /**
     * Show the form for editing the specified LogsVehicle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            Flash::error('Logs Vehicle not found');

            return redirect(route('logsVehicles.index'));
        }

        return view('logs_vehicles.edit')->with('logsVehicle', $logsVehicle);
    }

    /**
     * Update the specified LogsVehicle in storage.
     *
     * @param  int              $id
     * @param UpdateLogsVehicleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogsVehicleRequest $request)
    {
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            Flash::error('Logs Vehicle not found');

            return redirect(route('logsVehicles.index'));
        }

        $logsVehicle = $this->logsVehicleRepository->update($request->all(), $id);

        Flash::success('Logs Vehicle updated successfully.');

        return redirect(route('logsVehicles.index'));
    }

    /**
     * Remove the specified LogsVehicle from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            Flash::error('Logs Vehicle not found');

            return redirect(route('logsVehicles.index'));
        }

        $this->logsVehicleRepository->delete($id);

        Flash::success('Logs Vehicle deleted successfully.');

        return redirect(route('logsVehicles.index'));
    }
}
