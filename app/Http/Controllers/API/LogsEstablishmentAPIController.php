<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogsEstablishmentAPIRequest;
use App\Http\Requests\API\UpdateLogsEstablishmentAPIRequest;
use App\Models\LogsEstablishment;
use App\Repositories\LogsEstablishmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LogsEstablishmentResource;
use Response;
use App\Models\Civilian;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;

/**
 * Class LogsEstablishmentController
 * @package App\Http\Controllers\API
 */

class LogsEstablishmentAPIController extends AppBaseController
{
    /** @var  LogsEstablishmentRepository */
    private $logsEstablishmentRepository;

    public function __construct(LogsEstablishmentRepository $logsEstablishmentRepo)
    {
        $this->logsEstablishmentRepository = $logsEstablishmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsEstablishments",
     *      summary="Get a listing of the LogsEstablishments.",
     *      tags={"LogsEstablishment"},
     *      description="Get all LogsEstablishments",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/LogsEstablishment")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $logsEstablishments = $this->logsEstablishmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->where('user_id', Auth::user()->id);

        return $this->sendResponse(LogsEstablishmentResource::collection($logsEstablishments), 'Logs Establishments retrieved successfully');
    }

    /**
     * @param CreateLogsEstablishmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/logsEstablishments",
     *      summary="Store a newly created LogsEstablishment in storage",
     *      tags={"LogsEstablishment"},
     *      description="Store LogsEstablishment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsEstablishment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsEstablishment")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LogsEstablishment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLogsEstablishmentAPIRequest $request)
    {
        $input = $request->all();
        
        //Parse host and user uuid to check type
        $host_p = substr($input['host_id'], 0, 1);
        if($host_p != 'e') return $this->sendError('Something went wrong');

        $input['user_id'] =  Auth::user()->guid;
        $input['host_id'] =  substr($input['host_id'], 2);

        $user = Civilian::where('guid', $input['user_id'])->first(); 
        $host = Establishment::where('guid', $input['host_id'])->first(); 

        if(is_null($user) && is_null($host)) return $this->sendError('Host not found');

        $input['user_id'] = $user->id;
        $input['host_id'] = $host->id;

        $logsEstablishment = $this->logsEstablishmentRepository->create($input);

        return $this->sendResponse(new LogsEstablishmentResource($logsEstablishment), 'Logs Establishment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsEstablishments/{id}",
     *      summary="Display the specified LogsEstablishment",
     *      tags={"LogsEstablishment"},
     *      description="Get LogsEstablishment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsEstablishment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LogsEstablishment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var LogsEstablishment $logsEstablishment */
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            return $this->sendError('Logs Establishment not found');
        }

        return $this->sendResponse(new LogsEstablishmentResource($logsEstablishment), 'Logs Establishment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLogsEstablishmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/logsEstablishments/{id}",
     *      summary="Update the specified LogsEstablishment in storage",
     *      tags={"LogsEstablishment"},
     *      description="Update LogsEstablishment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsEstablishment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsEstablishment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsEstablishment")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LogsEstablishment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLogsEstablishmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var LogsEstablishment $logsEstablishment */
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            return $this->sendError('Logs Establishment not found');
        }

        $logsEstablishment = $this->logsEstablishmentRepository->update($input, $id);

        return $this->sendResponse(new LogsEstablishmentResource($logsEstablishment), 'LogsEstablishment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/logsEstablishments/{id}",
     *      summary="Remove the specified LogsEstablishment from storage",
     *      tags={"LogsEstablishment"},
     *      description="Delete LogsEstablishment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsEstablishment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var LogsEstablishment $logsEstablishment */
        $logsEstablishment = $this->logsEstablishmentRepository->find($id);

        if (empty($logsEstablishment)) {
            return $this->sendError('Logs Establishment not found');
        }

        $logsEstablishment->delete();

        return $this->sendSuccess('Logs Establishment deleted successfully');
    }
}
