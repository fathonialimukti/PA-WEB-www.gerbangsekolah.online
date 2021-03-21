<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthAPIController extends Controller
{
    private $response = [
        'message'   => null,
        'data'      => null,
    ];

    public function login(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('email',$request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'   => "failed"
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        $this->response['message']  = 'success';
        $this->response['data']     = ['token'=>$token];

        return response()->json($this->response, 200);
    }

    public function currentUser(){
        $this->response['message']  = 'success';
        $this->response['data']     = auth()->user();

        return response()->json($this->response,200);        
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();

        $this->response['message'] = 'success';

        return response()->json($this->response,200);
    }
}
