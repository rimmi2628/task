<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Validator;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            
        ]);
        

        if($validator->fails()) {
           return response()->json(['error'=>$validator->errors()]);
        }
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            
        return response()->json(['msg'=>'Register successful!']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }


    public function createCustomer(Request $request)
    {
        
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => '1',
                'password' => Hash::make($request->password)
            ]);
            
        return response()->json(['msg'=>'Customer create successful!']);
    }

    public function createOperator(Request $request)
    {
        
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => '2',
                'password' => Hash::make($request->password)
            ]);
            
        return response()->json(['msg'=>'Operator create successful!']);
    }

    public function updateCustomer(Request $request)
    {
        $user = auth()->user();
        $data = User::find($user->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        
            
        return response()->json(['msg'=>'Customer update successful!']);
    }

    public function updateOperator(Request $request)
    {
        $user = auth()->user();
        $data = User::find($user->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        
            
        return response()->json(['msg'=>'Operator update successful!']);
    }

}
