<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends Controller
{
    private $response;

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->first();

        if($user == null)
        {
            return response()->json([
            'message' => 'Email tidak terdaftar'
            ]);
        }

        if (!$user || ! Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => "Password Salah"
            ]);
        }

        $token =  $user->createToken($req->device_name)->plainTextToken;
        $this->response['message']  = 'Login success';
        $this->response['token']    = $token;

        return response()->json($this->response, 200);
    }

    public function profile()
    {
        $this->response['id']   = auth()->user()->id;
        $this->response['name']   = auth()->user()->name;
        $this->response['email']   = auth()->user()->email;
        $this->response['profile_picture']   = auth()->user()->profile_picture;

        //check isTeacher
        if(auth()->user()->roles->pluck( 'name' )->contains( 'Teacher' )){
            $this->response['isTeacher']    = true;
            $this->response['grades']       = auth()->user()->teacher->grades;
        } else {
            $this->response['isTeacher']    = false;
            $this->response['grades']        = auth()->user()->student->grade;
        }

        return response()->json($this->response, 200);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        $this->response['message'] = 'Logout success';

        return response()->json($this->response, 200);
    }
}
