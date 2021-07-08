<?php

namespace App\Http\Controllers;

use App\DataTables\EstablishmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;
use App\Repositories\EstablishmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Str;
use NominatimLaravel\Content\Nominatim;
class EstablishmentController extends AppBaseController
{
    /** @var  EstablishmentRepository */
    private $establishmentRepository;
    private $type = ['Stall','Shop','Fastfood','Mall','Grocery','Supermarket','Hospital'];

    public function __construct(EstablishmentRepository $establishmentRepo)
    {
        $this->establishmentRepository = $establishmentRepo;
    }

    /**
     * Display a listing of the Establishment.
     *
     * @param EstablishmentDataTable $establishmentDataTable
     * @return Response
     */
    public function index(EstablishmentDataTable $establishmentDataTable)
    {

        return $establishmentDataTable->render('establishments.index');
    }

    /**
     * Show the form for creating a new Establishment.
     *
     * @return Response
     */
    public function create()
    {
        return view('establishments.create');
    }

    /**
     * Store a newly created Establishment in storage.
     *
     * @param CreateEstablishmentRequest $request
     *
     * @return Response
     */
    public function store(CreateEstablishmentRequest $request)
    {
        $input = $request->all();

        
        //Add GUID 
        $input['guid'] = (string) Str::uuid();
        //Add specific establishment type
        $input['type'] = $this->type[$request['type']]; 

        $establishment = $this->establishmentRepository->create($input);

        Flash::success('Establishment saved successfully.');

        return redirect(route('establishments.index'));
    }

    /**
     * Display the specified Establishment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        
        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        return view('establishments.show')->with('establishment', $establishment);
    }

    /**
     * Show the form for editing the specified Establishment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        return view('establishments.edit')->with('establishment', $establishment);
    }

    /**
     * Update the specified Establishment in storage.
     *
     * @param  int              $id
     * @param UpdateEstablishmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstablishmentRequest $request)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        $request['type'] = $this->type[$request['type']]; 
        $establishment = $this->establishmentRepository->update($request->all(), $id);

        Flash::success('Establishment updated successfully.');

        return redirect(route('establishments.index'));
    }

    /**
     * Remove the specified Establishment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        $this->establishmentRepository->delete($id);

        Flash::success('Establishment deleted successfully.');

        return redirect(route('establishments.index'));
    }

    public function print($uuid){ 
        $pdf = PDF::loadHTML('<img src="data:image/svg+xml;base64, '. base64_encode(QrCode::format('svg')->size(300)->generate('e-'.$uuid)).'">')
        ->setPaper('a4', 'portrait');

        return $pdf->stream(); 
    }
}
