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
        $input['full_name'] = $request['first_name']. ' ' . $request['last_name'];
        
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
        $url = 'https://fcm.googleapis.com/fcm/send';
        $user = Civilian::where([
            ['id', '=', $id],
            ['status', '<', $request['status']]
        ]);
        $message = '';
         switch($request->status){ 
            case 0:
                $message = 'Keep safe, always stay at home';
            break; 

            case 1: 
                $message = 'Possible contact with infected person';
            break;

            case 2: 
                $message = 'Keep safe, always stay at home';
            break;

            case 3: 
                $message = 'You are infected of COVID-19';
            break;

            case 4: 
                $message = 'Stay healthy, always stay at home';
            break; 
            
            default:
                $message = '';
        }

        $serverKey = 'AAAAJJrq55s:APA91bGJL0WrPv1FSL8fQWJikq5RpqvGmRuYCnj6cPqPqCFvRumi9VVaPWG72S6s1fD-x8HRO4Lh7PBifEWylC-xiBLBWnlNdd8ffTSwggJcRJvRQ5GauR94JUuhmFmerIwzPEV3gCi-';

        $token = $user->first()->token;

        $data = [
            "registration_ids" => [
                $token
            ],
            "notification" => [
                "title" => 'COVID-19 Status Update',
                "body" => $message,  
            ]
        ];

        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        

        // Close connection
        curl_close($ch);
        // Send push notification to mobile when suspected 
        
        $user->update([
            'status' => $request->status,
        ]);

        return response()->json(['success'=> true]);
    }
}
