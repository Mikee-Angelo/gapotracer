<?php

namespace App\Http\Controllers;

use App\DataTables\CivilianDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCivilianRequest;
use App\Http\Requests\UpdateCivilianRequest;
use App\Repositories\CivilianRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Str;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Models\Civilian;

class CivilianController extends AppBaseController
{
    /** @var  CivilianRepository */
    private $civilianRepository;

    public function __construct(CivilianRepository $civilianRepo)
    {
        $this->civilianRepository = $civilianRepo;
    }

    /**
     * Display a listing of the Civilian.
     *
     * @param CivilianDataTable $civilianDataTable
     * @return Response
     */
    public function index(CivilianDataTable $civilianDataTable)
    {
        return $civilianDataTable->render('civilians.index');
    }

    /**
     * Show the form for creating a new Civilian.
     *
     * @return Response
    */
    public function create()
    {
        return view('civilians.create');
    }

    /**
     * Store a newly created Civilian in storage.
     *
     * @param CreateCivilianRequest $request
     *
     * @return Response
     */
    public function store(CreateCivilianRequest $request)
    {
        $input = $request->all();
        
        //Add GUID 
        $input['guid'] = (string) Str::uuid();
        $input['gender'] = $request['gender'] == 0 ? 'Male' : 'Female';
        
        $civilian = $this->civilianRepository->create($input);

        Flash::success('Civilian saved successfully.');

        return redirect(route('civilians.index'));
    }

    /**
     * Display the specified Civilian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $civilian = $this->civilianRepository->find($id);

        if (empty($civilian)) {
            Flash::error('Civilian not found');

            return redirect(route('civilians.index'));
        }

        return view('civilians.show')->with('civilian', $civilian);
    }

    /**
     * Show the form for editing the specified Civilian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $civilian = $this->civilianRepository->find($id);

        if (empty($civilian)) {
            Flash::error('Civilian not found');

            return redirect(route('civilians.index'));
        }
        
        return view('civilians.edit')->with('civilian', $civilian);
    }

    /**
     * Update the specified Civilian in storage.
     *
     * @param  int              $id
     * @param UpdateCivilianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCivilianRequest $request)
    {
        $civilian = $this->civilianRepository->find($id);

        if (empty($civilian)) {
            Flash::error('Civilian not found');

            return redirect(route('civilians.index'));
        }

        $civilian = $this->civilianRepository->update($request->all(), $id);

        Flash::success('Civilian updated successfully.');

        return redirect(route('civilians.index'));
    }

    /**
     * Remove the specified Civilian from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $civilian = $this->civilianRepository->find($id);

        if (empty($civilian)) {
            Flash::error('Civilian not found');

            return redirect(route('civilians.index'));
        }

        $this->civilianRepository->delete($id);

        Flash::success('Civilian deleted successfully.');

     
        return redirect(route('civilians.index'));
    }

    public function print($uuid){ 
        $pdf = PDF::loadHTML('<img src="data:image/svg+xml;base64, '. base64_encode(QrCode::format('svg')->size(300)->generate('c-'.$uuid)).'">')
        ->setPaper('a4', 'portrait');

        return $pdf->stream(); 
    }

    public function status($id, Request $request){ 
        Civilian::where([
            ['id', '=', $id],
            ['status', '<', $request['status']]
        ])->update([
            'status' => $request->status,
        ]);

        return response()->json(['success'=> true]);
    }
}
