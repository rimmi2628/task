<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    //

    public function createcustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|min:6'
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
            
        session()->flash('success','Customer create sucessfully');
        return response()->json(['msg'=>'Customer create successful!']);
    }


    public function updatecustomer(Request $request)
    {

        $customer =Customer::find($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
    
        return response()->json(['msg'=>'Customer update successful!']);
    }
}



