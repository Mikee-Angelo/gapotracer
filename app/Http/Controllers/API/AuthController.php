<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Civilian;
use App\Http\Requests\RegisterApiRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterApiRequest $request)
    {
        $validated = $request->validated(); 

        $validated['password'] = bcrypt($request->password);

        $validated['full_name'] = $request->first_name. ' ' . $request->last_name;

        $validated['guid'] = (string) Str::uuid();

        $user = Civilian::create($validated);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = Civilian::where(['phone' => $request->phone])->first(); 

        if(is_null($user)){ 
            return response(['message' => 'Invalid Credentials']);
        }

        $pwd = password_verify($request->password, $user->password);
        
        if(!$pwd){ 
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);

    }
}