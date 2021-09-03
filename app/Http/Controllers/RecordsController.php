<?php

namespace App\Http\Controllers;

use App\DataTables\RecordsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRecordsRequest;
use App\Http\Requests\UpdateRecordsRequest;
use App\Repositories\RecordsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RecordsController extends AppBaseController
{
    /** @var  RecordsRepository */
    private $recordsRepository;

    public function __construct(RecordsRepository $recordsRepo)
    {
        $this->recordsRepository = $recordsRepo;
    }

    /**
     * Display a listing of the Records.
     *
     * @param RecordsDataTable $recordsDataTable
     * @return Response
     */
    public function index(RecordsDataTable $recordsDataTable)
    {
        return $recordsDataTable->render('records.index');
    }

    /**
     * Show the form for creating a new Records.
     *
     * @return Response
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created Records in storage.
     *
     * @param CreateRecordsRequest $request
     *
     * @return Response
     */
    public function store(CreateRecordsRequest $request)
    {
        $input = $request->all();

        $records = $this->recordsRepository->create($input);

        Flash::success('Records saved successfully.');

        return redirect(route('records.index'));
    }

    /**
     * Display the specified Records.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $records = $this->recordsRepository->find($id);

        if (empty($records)) {
            Flash::error('Records not found');

            return redirect(route('records.index'));
        }

        return view('records.show')->with('records', $records);
    }

    /**
     * Show the form for editing the specified Records.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $records = $this->recordsRepository->find($id);

        if (empty($records)) {
            Flash::error('Records not found');

            return redirect(route('records.index'));
        }

        return view('records.edit')->with('records', $records);
    }

    /**
     * Update the specified Records in storage.
     *
     * @param  int              $id
     * @param UpdateRecordsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecordsRequest $request)
    {
        $records = $this->recordsRepository->find($id);

        if (empty($records)) {
            Flash::error('Records not found');

            return redirect(route('records.index'));
        }

        $records = $this->recordsRepository->update($request->all(), $id);

        Flash::success('Records updated successfully.');

        return redirect(route('records.index'));
    }

    /**
     * Remove the specified Records from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $records = $this->recordsRepository->find($id);

        if (empty($records)) {
            Flash::error('Records not found');

            return redirect(route('records.index'));
        }

        $this->recordsRepository->delete($id);

        Flash::success('Records deleted successfully.');

        return redirect(route('records.index'));
    }
}
