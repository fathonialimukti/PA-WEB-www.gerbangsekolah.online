<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends Controller
{
    private $response = [
        'message'   => null,
        'data'      => null,
    ];

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->first();

        if (!$user || ! Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => "failed"
            ]);
        }

        $token =  $user->createToken($req->device_name)->plainTextToken;
        $this->response['message']  = 'success';
        $this->response['data']     = ['token' => $token];

        return response()->json($this->response, 200);
    }

    public function profile()
    {
        $this->response['message'] = 'success';
        $this->response['data'] = auth()->user();

        //check isTeacher
        if(auth()->user()->roles->pluck( 'name' )->contains( 'Teacher' )){
            $this->response['data']['isTeacher'] = true;
        } else {
            $this->response['data']['isTeacher'] = false;
        }

        return response()->json($this->response, 200);
    }

    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();

        $this->response['message'] = 'success';

        return response()->json($this->response, 200);
    }
}
