<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employees;
use Validator;
use App\Http\Resources\Employees as EmployeesResource;
   
class EmployeesController extends BaseController
{
    public function index()
    {
        $employees = Employees::all();
    
        return $this->sendResponse(EmployeesResource::collection($employees), 'Employees retrieved successfully.');
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
   
        $employees = Employees::create($input);
   
        return $this->sendResponse(new EmployeesResource($employees), 'Employees created successfully.');
    } 
   
    public function show($id)
    {
        $employees = Employees::find($id);
  
        if (is_null($employees)) {
            return $this->sendError('Employees not found.');
        }
   
        return $this->sendResponse(new EmployeesResource($employees), 'Employees retrieved successfully.');
    }
    
    public function update(Request $request, Employees $employees)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $employees->name = $input['name'];
        $employees->detail = $input['detail'];
        $employees->save();
   
        return $this->sendResponse(new EmployeesResource($employees), 'Employees updated successfully.');
    }
   
    public function destroy(Employees $employees)
    {
        $employees->delete();
   
        return $this->sendResponse([], 'Employees deleted successfully.');
    }
}
