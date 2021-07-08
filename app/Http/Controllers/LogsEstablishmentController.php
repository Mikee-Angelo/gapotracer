<?php

namespace App\Http\Controllers;

use App\DataTables\LogsEstablishmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLogsEstablishmentRequest;
use App\Http\Requests\UpdateLogsEstablishmentRequest;
use App\Repositories\LogsEstablishmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Civilian; 
use App\Models\Establishment;

class LogsEstablishmentController extends AppBaseController
{
    /** @var  LogsEstablishmentRepository */
    private $logsEstablishmentRepository;

    public function __construct(LogsEstablishmentRepository $logsEstablishmentRepo)
    {
        $this->logsEstablishmentRepository = $logsEstablishmentRepo;
    }

    /**
     * Display a listing of the LogsEstablishment.
     *
     * @param LogsEstablishmentDataTable $logsEstablishmentDataTable
     * @return Response
     */
    public function index(LogsEstablishmentDataTable $logsEstablishmentDataTable)
    {
        return $logsEstablishmentDataTable->render('logs_establishments.index');
    }

    /**
     * Show the form for creating a new LogsEstablishment.
     *
     * @return Response
     */
    public function create()
    {
        return view('logs_establishments.create');
    }

    /**
     * Store a newly created LogsEstablishment in storage.
     *
     * @param CreateLogsEstablishmentRequest $request
     *
     * @return Response
     */
    public function store(CreateLogsEstablishmentRequest $request)
    {
        $input = $request->all();

        //Parse host and user uuid to check type
        $user_p = substr($input['user_id'], 0, 1);
        $host_p = substr($input['host_id'], 0, 1);

        if($host_p != 'e' && $user_p != 'c') return abort(404);  

        $input['user_id'] =  substr($input['user_id'], 2);
        $input['host_id'] =  substr($input['host_id'], 2);

        $user = Civilian::where('guid', $input['user_id'])->first(); 
        $host = Establishment::where('guid', $input['host_id'])->first(); 


        if(is_null($user) && is_null($host)) return abort(404); 

        $input['user_id'] = $user->id;
        $input['host_id'] = $host->id;
        
        $logsEstablishment = $this->logsEstablishmentRepository->create($input);

        Flash::success('Logs Establishment saved successfully.');

        return redirect(route('logsEstablishments.index'));
    }

    /**
     * Display the specified LogsEstablishment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            Flash::error('Logs Establishment not found');

            return redirect(route('logsEstablishments.index'));
        }

        return view('logs_establishments.show')->with('logsEstablishment', $logsEstablishment);
    }

    /**
     * Show the form for editing the specified LogsEstablishment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            Flash::error('Logs Establishment not found');

            return redirect(route('logsEstablishments.index'));
        }

        return view('logs_establishments.edit')->with('logsEstablishment', $logsEstablishment);
    }

    /**
     * Update the specified LogsEstablishment in storage.
     *
     * @param  int              $id
     * @param UpdateLogsEstablishmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogsEstablishmentRequest $request)
    {
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            Flash::error('Logs Establishment not found');

            return redirect(route('logsEstablishments.index'));
        }

        $logsEstablishment = $this->logsEstablishmentRepository->update($request->all(), $id);

        Flash::success('Logs Establishment updated successfully.');

        return redirect(route('logsEstablishments.index'));
    }

    /**
     * Remove the specified LogsEstablishment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            Flash::error('Logs Establishment not found');

            return redirect(route('logsEstablishments.index'));
        }

        $this->logsEstablishmentRepository->delete($id);

        Flash::success('Logs Establishment deleted successfully.');

        return redirect(route('logsEstablishments.index'));
    }
}
