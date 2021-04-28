<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Clients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\Clients as ClientsResource;
   
class ClientsController extends BaseController
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'state' => 'required',      
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['token'] = Str::random(100);
        $client = Clients::create($input);
        return $this->sendResponse(['token' => $client->token], "Client created");
    }

    public function list_all_clients() {
        return Clients::all();
    }
    
    public function show_one_client($id) {
        return Clients::find($id);
    }

    public function search($name) {
        return Clients::where("name" ,$name)->get();
    }
    
    public function update (Request $request) {

        $client = Clients::find($request->id);
        $client->name = $request->name;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->post_code = $request->post_code;
        $client->state = $request->state;
        $result = $client->save();

        if($result) {
            return ["result" => "Data has been updated."];
        }

        else {
            return ["result" => "Data hasn't been updated."];
        }
    }

    public function delete ($id) {
        $client = Clients::find($id);
        $result = $client->delete();

        if($result) {
            return ["result" => "Client has been deleted."];
        }

        else {
            return ["result" => "Error. Client hasn't been deleted."];
        }
    }
    
   
    
}
