<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\Projects as ProjectsResource;
   
class ProjectsController extends BaseController
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

    public function login(Request $request)
    {    //'password' => $request->password treba dodati pored email-a kada u tabeli imamo password
        if(Auth::attempt(['email' => $request->email])){
            $project = Auth::project();
            $project['token'] =  $project->createToken('MyApp')-> accessToken;
            $project['name'] =  $project->name;

            return $this->sendResponse($success, 'Project login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
    /*
    public function index()
    {
        $products = Products::all();
    
        return $this->sendResponse(ProductsResource::collection($products), 'Products retrieved successfully.');
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
   
        $projects = Projects::create($input);
   
        return $this->sendResponse(new ProjectsResource($projects), 'Projects created successfully.');
    } 
   
    public function show($id)
    {
        $projects = Projects::find($id);
  
        if (is_null($projects)) {
            return $this->sendError('Projects not found.');
        }
   
        return $this->sendResponse(new ProjectsResource($projects), 'Projects retrieved successfully.');
    }
    
    public function update(Request $request, Projects $projects)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $projects->name = $input['name'];
        $projects->detail = $input['detail'];
        $projects->save();
   
        return $this->sendResponse(new ProjectsResource($projects), 'Projects updated successfully.');
    }
   
    public function destroy(Projects $projects)
    {
        $projects->delete();
   
        return $this->sendResponse([], 'Projects deleted successfully.');
    }
    */
}
