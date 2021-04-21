<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'role' => 'required',
            'hours_per_week' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

     //   $input['password'] = bcrypt($input['password']); nemamo password i ne mozemo ga koristiti
        $input['token'] = Str::random(100);

        $employee = Employees::create($input);

        return $this->sendResponse(['token' => $employee->token], "Employee created");
    }

    public function login(Request $request)
    {    //'password' => $request->password treba dodati pored email-a kada u tabeli imamo password
        if(Auth::attempt(['email' => $request->email])){
            $employee = Auth::employee();
            $success['token'] =  $employee->createToken('MyApp')-> accessToken;
            $success['name'] =  $employee->name;

            return $this->sendResponse($success, 'Employee login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
