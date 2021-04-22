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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'role' => 'required',
            'hours_per_week' => 'required'
        ]);

    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

     //   $input['password'] = bcrypt($input['password']); nemamo password i ne mozemo ga koristiti
        $input['token'] = Str::random(100);

        $client = Clients::create($input);

        return $this->sendResponse(['token' => $client->token], "Client created");
    }

    public function login(Request $request)
    {    //'password' => $request->password treba dodati pored email-a kada u tabeli imamo password
        if(Auth::attempt(['email' => $request->email])){
            $client = Auth::client();
            $client['token'] =  $client->createToken('MyApp')-> accessToken;
            $client['name'] =  $client->name;

            return $this->sendResponse($success, 'Employee login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
    public function index()
    {
        $clients = Clients::all();
    
        return $this->sendResponse(ClientsResource::collection($clients), 'Clients retrieved successfully.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $clients = Clients::create($input);
   
        return $this->sendResponse(new ClientsResource($clients), 'Clients created successfully.');
    } 
   
    public function show($id)
    {
        $clients = Clients::find($id);
  
        if (is_null($clients)) {
            return $this->sendError('Clients not found.');
        }
   
        return $this->sendResponse(new ClientsResource($clients), 'Clients retrieved successfully.');
    }
    
    public function update(Request $request, Clients $clients)
    { 
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $clients->name = $input['name'];
        $clients->detail = $input['detail'];
        $clients->save();
   
        return $this->sendResponse(new ClientsResource($clients), 'Clients updated successfully.');
    }
   
    public function destroy(Clients $clients)
    {
        $clients->delete();
   
        return $this->sendResponse([], 'Clients deleted successfully.');
    }
}
