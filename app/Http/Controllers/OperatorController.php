<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operator;
class OperatorController extends Controller
{
    //

    public function createoperator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|confirmed|min:10',
            'address' => 'required|string'
            
        ]);
        

        if($validator->fails()) {
           return response()->json(['error'=>$validator->errors()]);
        }
        $user = User::create([
                'name' => $request->first_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' =>$request->phone,
            ]);
            
        session()->flash('success', 'Operator create suceesfully');
        return response()->json(['msg'=>'Operator Create successful!']);
    }

    public function updateoperator(Request $request)
    {

        $operator =Operator::find($request->id);
        $operator->name = $request->name;
        $operator->email = $request->email;
        $operator->address = $request->address;
        $operator->phone = $request->phone;
        $operator->save();
    
        return response()->json(['msg'=>'operator update successful!']);
    }
}
