<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogsVehicleAPIRequest;
use App\Http\Requests\API\UpdateLogsVehicleAPIRequest;
use App\Models\LogsVehicle;
use App\Repositories\LogsVehicleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LogsVehicleResource;
use Response;
use App\Models\Vehicles;
use App\Models\Civilian;
use Illuminate\Support\Facades\Auth;

/**
 * Class LogsVehicleController
 * @package App\Http\Controllers\API
 */

class LogsVehicleAPIController extends AppBaseController
{
    /** @var  LogsVehicleRepository */
    private $logsVehicleRepository;

    public function __construct(LogsVehicleRepository $logsVehicleRepo)
    {
        $this->logsVehicleRepository = $logsVehicleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsVehicles",
     *      summary="Get a listing of the LogsVehicles.",
     *      tags={"LogsVehicle"},
     *      description="Get all LogsVehicles",
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
     *                  @SWG\Items(ref="#/definitions/LogsVehicle")
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
        $logsVehicles = $this->logsVehicleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->where('user_id', Auth::user()->id);

        return $this->sendResponse(LogsVehicleResource::collection($logsVehicles), 'Logs Vehicles retrieved successfully');
    }

    /**
     * @param CreateLogsVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/logsVehicles",
     *      summary="Store a newly created LogsVehicle in storage",
     *      tags={"LogsVehicle"},
     *      description="Store LogsVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsVehicle that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsVehicle")
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
     *                  ref="#/definitions/LogsVehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLogsVehicleAPIRequest $request)
    {
        $input = $request->all();

        //Parse host and user uuid to check type
        $host_p = substr($input['host_id'], 0, 1);
        if($host_p != 'v') return $this->sendError('Something went wrong');

        $input['user_id'] =  Auth::user()->guid;
        $input['host_id'] =  substr($input['host_id'], 2);

        $user = Civilian::where('guid', $input['user_id'])->first(); 
        $host = Vehicles::where('guid', $input['host_id'])->first(); 

        if(is_null($user) && is_null($host)) return $this->sendError('Host not found');

        $input['user_id'] = $user->id;
        $input['host_id'] = $host->id;

        $logsVehicle = $this->logsVehicleRepository->create($input);

        return $this->sendResponse(new LogsVehicleResource($logsVehicle), 'Logs Vehicle saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsVehicles/{id}",
     *      summary="Display the specified LogsVehicle",
     *      tags={"LogsVehicle"},
     *      description="Get LogsVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsVehicle",
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
     *                  ref="#/definitions/LogsVehicle"
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
        /** @var LogsVehicle $logsVehicle */
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            return $this->sendError('Logs Vehicle not found');
        }

        return $this->sendResponse(new LogsVehicleResource($logsVehicle), 'Logs Vehicle retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLogsVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/logsVehicles/{id}",
     *      summary="Update the specified LogsVehicle in storage",
     *      tags={"LogsVehicle"},
     *      description="Update LogsVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsVehicle",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsVehicle that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsVehicle")
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
     *                  ref="#/definitions/LogsVehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLogsVehicleAPIRequest $request)
    {
        $input = $request->all();

        /** @var LogsVehicle $logsVehicle */
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            return $this->sendError('Logs Vehicle not found');
        }

        $logsVehicle = $this->logsVehicleRepository->update($input, $id);

        return $this->sendResponse(new LogsVehicleResource($logsVehicle), 'LogsVehicle updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/logsVehicles/{id}",
     *      summary="Remove the specified LogsVehicle from storage",
     *      tags={"LogsVehicle"},
     *      description="Delete LogsVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsVehicle",
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
        /** @var LogsVehicle $logsVehicle */
        $logsVehicle = $this->logsVehicleRepository->find($id);

        if (empty($logsVehicle)) {
            return $this->sendError('Logs Vehicle not found');
        }

        $logsVehicle->delete();

        return $this->sendSuccess('Logs Vehicle deleted successfully');
    }
}
