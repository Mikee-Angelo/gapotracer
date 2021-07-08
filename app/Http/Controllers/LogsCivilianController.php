<?php

namespace App\Http\Controllers;

use App\DataTables\LogsCivilianDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLogsCivilianRequest;
use App\Http\Requests\UpdateLogsCivilianRequest;
use App\Repositories\LogsCivilianRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Civilian;
use Illuminate\Support\Facades\DB;
class LogsCivilianController extends AppBaseController
{
    /** @var  LogsCivilianRepository */
    private $logsCivilianRepository;

    public function __construct(LogsCivilianRepository $logsCivilianRepo)
    {
        $this->logsCivilianRepository = $logsCivilianRepo;
    }

    /**
     * Display a listing of the LogsCivilian.
     *
     * @param LogsCivilianDataTable $logsCivilianDataTable
     * @return Response
     */
    public function index(LogsCivilianDataTable $logsCivilianDataTable)
    {
        return $logsCivilianDataTable->render('logs_civilians.index');
    }

    /**
     * Show the form for creating a new LogsCivilian.
     *
     * @return Response
     */
    public function create()
    {
        return view('logs_civilians.create');
    }

    /**
     * Store a newly created LogsCivilian in storage.
     *
     * @param CreateLogsCivilianRequest $request
     *
     * @return Response
     */
    public function store(CreateLogsCivilianRequest $request)
    {
        $input = $request->all();
        //Parse host and user uuid to check type
        $user_p = substr($input['user_id'], 0, 1);
        $host_p = substr($input['host_id'], 0, 1);

        if($host_p != 'c' && $user_p != 'c') return abort(404);  

        $input['user_id'] =  substr($input['user_id'], 2);
        $input['host_id'] =  substr($input['host_id'], 2);
        

        $user = Civilian::whereIn('guid', [$input['user_id'], $input['host_id']])
        ->orderByRaw(DB::raw("FIELD(guid,'".$input['user_id']."', '".$input['host_id']."')"))
        ->get();

        if(count($user) != 2) return abort(404); 

        $input['user_id'] = $user[0]['id'];
        $input['host_id'] = $user[1]['id'];

        $logsCivilian = $this->logsCivilianRepository->create($input);

        Flash::success('Logs Civilian saved successfully.');

        return redirect(route('logsCivilians.index'));
    }

    /**
     * Display the specified LogsCivilian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            Flash::error('Logs Civilian not found');

        return redirect(route('logsCivilians.index'));
        }

        return view('logs_civilians.show')->with('logsCivilian', $logsCivilian);
    }

    /**
     * Show the form for editing the specified LogsCivilian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            Flash::error('Logs Civilian not found');

            return redirect(route('logsCivilians.index'));
        }

        return view('logs_civilians.edit')->with('logsCivilian', $logsCivilian);
    }

    /**
     * Update the specified LogsCivilian in storage.
     *
     * @param  int              $id
     * @param UpdateLogsCivilianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogsCivilianRequest $request)
    {
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            Flash::error('Logs Civilian not found');

            return redirect(route('logsCivilians.index'));
        }

        $logsCivilian = $this->logsCivilianRepository->update($request->all(), $id);

        Flash::success('Logs Civilian updated successfully.');

        return redirect(route('logsCivilians.index'));
    }

    /**
     * Remove the specified LogsCivilian from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            Flash::error('Logs Civilian not found');

            return redirect(route('logsCivilians.index'));
        }

        $this->logsCivilianRepository->delete($id);

        Flash::success('Logs Civilian deleted successfully.');

        return redirect(route('logsCivilians.index'));
    }
}
