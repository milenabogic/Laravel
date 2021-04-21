<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project' => 'required',
            'name_client' => 'required',
            'name_employee' => 'required',
            'status_project' => 'required',
            'archived_project' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

     //   $input['password'] = bcrypt($input['password']); nemamo password i ne mozemo ga koristiti
        $input['token'] = Str::random(100);

        $project = Projects::create($input);

        return $this->sendResponse(['token' => $project->token], "Project created");
    }

    /*public function login(Request $request)
    {    //'password' => $request->password treba dodati pored email-a kada u tabeli imamo password
        if(Auth::attempt(['email' => $request->email])){
            $client = Auth::client();
            $client['token'] =  $client->createToken('MyApp')-> accessToken;
            $client['name'] =  $client->name;

            return $this->sendResponse($success, 'Client login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }*/
}
