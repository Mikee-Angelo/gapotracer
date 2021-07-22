<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Civilian;
use App\Http\Requests\RegisterApiRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterApiRequest $request)
    {
        $validated = $request->validated(); 

        $validated['password'] = Hash::make($request->password);

        $validated['gender'] = $request['gender'] == 0 ? 'Male' : 'Female';
        $validated['full_name'] = $request->first_name. ' ' . $request->last_name;

        $validated['guid'] = (string) Str::uuid();
        
        $user = Civilian::create($validated);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'status' => true, 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'token' => 'required|string',
        ]);

        $user = Civilian::where(['phone' => $request->phone])->first(); 
        
        if(is_null($user)){ 
            return response(['message' => 'Invalid Credentials']);
        }

        $hash = Hash::check($request->password, $user->password);
        if(!$hash){ 
            return response(['message' => 'Invalid Credentials']);
        }
        
        $user->update(['token' => $request->token]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);

    }

    public function status(){ 
        $status = Auth::user()->status;
        $message = ''; 

        switch($status){ 
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
        
        return response([ 'status' => true, 'tracer_status' =>  $status , 'message' => $message]);
    }
}