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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'post_code' => 'required|numeric',
            'state' => 'required|string|max:255',      
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $client = Clients::create($input);

        if ($client->exists()) {
            return(new ClientsResource($client))->response()->setStatusCode(201);
        }
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
