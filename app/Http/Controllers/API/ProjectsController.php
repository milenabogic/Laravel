<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Projects;
use Validator;
use App\Http\Resources\Projects as ClientsResource;
   
class ProjectsController extends BaseController
{
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
}
