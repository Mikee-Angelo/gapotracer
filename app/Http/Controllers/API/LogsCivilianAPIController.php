<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogsCivilianAPIRequest;
use App\Http\Requests\API\UpdateLogsCivilianAPIRequest;
use App\Models\LogsCivilian;
use App\Repositories\LogsCivilianRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LogsCivilianResource;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Civilian;
/**
 * Class LogsCivilianController
 * @package App\Http\Controllers\API
 */

class LogsCivilianAPIController extends AppBaseController
{
    /** @var  LogsCivilianRepository */
    private $logsCivilianRepository;

    public function __construct(LogsCivilianRepository $logsCivilianRepo)
    {
        $this->logsCivilianRepository = $logsCivilianRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsCivilians",
     *      summary="Get a listing of the LogsCivilians.",
     *      tags={"LogsCivilian"},
     *      description="Get all LogsCivilians",
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
     *                  @SWG\Items(ref="#/definitions/LogsCivilian")
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
        $logsCivilians = $this->logsCivilianRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
        )->where('user_id', Auth::user()->id);

        return $this->sendResponse(LogsCivilianResource::collection($logsCivilians), 'Logs Civilians retrieved successfully');
    }

    /**
     * @param CreateLogsCivilianAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/logsCivilians",
     *      summary="Store a newly created LogsCivilian in storage",
     *      tags={"LogsCivilian"},
     *      description="Store LogsCivilian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsCivilian that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsCivilian")
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
     *                  ref="#/definitions/LogsCivilian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLogsCivilianAPIRequest $request)
    {
        $input = $request->all();

        //Parse host and user uuid to check type
        $host_p = substr($input['host_id'], 0, 1);
        if($host_p != 'c') return $this->sendError('Something went wrong');
        $input['user_id'] =  Auth::user()->guid;
        $input['host_id'] =  substr($input['host_id'], 2);
        

        $user = Civilian::whereIn('guid', [$input['user_id'], $input['host_id']])
        ->orderByRaw(DB::raw("FIELD(guid,'".$input['user_id']."', '".$input['host_id']."')"))
        ->get();

        if(count($user) != 2)return $this->sendError('Host not Found');

        $input['user_id'] = $user[0]['id'];
        $input['host_id'] = $user[1]['id'];
        
        $logsCivilian = $this->logsCivilianRepository->create($input);

        return $this->sendResponse(new LogsCivilianResource($logsCivilian), 'Logs Civilian saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/logsCivilians/{id}",
     *      summary="Display the specified LogsCivilian",
     *      tags={"LogsCivilian"},
     *      description="Get LogsCivilian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsCivilian",
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
     *                  ref="#/definitions/LogsCivilian"
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
        /** @var LogsCivilian $logsCivilian */
        $logsCivilian = $this->logsCivilianRepository->find($id);
    
        if (empty($logsCivilian)) {
            return $this->sendError('Logs Civilian not found');
        }

        return $this->sendResponse(new LogsCivilianResource($logsCivilian), 'Logs Civilian retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLogsCivilianAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/logsCivilians/{id}",
     *      summary="Update the specified LogsCivilian in storage",
     *      tags={"LogsCivilian"},
     *      description="Update LogsCivilian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsCivilian",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LogsCivilian that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LogsCivilian")
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
     *                  ref="#/definitions/LogsCivilian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLogsCivilianAPIRequest $request)
    {
        $input = $request->all();

        /** @var LogsCivilian $logsCivilian */
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            return $this->sendError('Logs Civilian not found');
        }

        $logsCivilian = $this->logsCivilianRepository->update($input, $id);

        return $this->sendResponse(new LogsCivilianResource($logsCivilian), 'LogsCivilian updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/logsCivilians/{id}",
     *      summary="Remove the specified LogsCivilian from storage",
     *      tags={"LogsCivilian"},
     *      description="Delete LogsCivilian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LogsCivilian",
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
        /** @var LogsCivilian $logsCivilian */
        $logsCivilian = $this->logsCivilianRepository->find($id);

        if (empty($logsCivilian)) {
            return $this->sendError('Logs Civilian not found');
        }

        $logsCivilian->delete();

        return $this->sendSuccess('Logs Civilian deleted successfully');
    }
}
