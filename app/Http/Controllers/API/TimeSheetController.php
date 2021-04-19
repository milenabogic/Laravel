<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\TimeSheets;
use Validator;
use App\Http\Resources\TimeSheets as ClientsResource;
   
class TimeSheetsController extends BaseController
{
    public function index()
    {
        $time_sheets = TimeSheets::all();
    
        return $this->sendResponse(TimeSheetsResource::collection($time_sheets), 'TimeSheets retrieved successfully.');
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
   
        $time_sheets = TimeSheets::create($input);
   
        return $this->sendResponse(new TimeSheetsResource($time_sheets), 'TimeSheets created successfully.');
    } 
   
    public function show($id)
    {
        $time_sheets = TimeSheets::find($id);
  
        if (is_null($time_sheets)) {
            return $this->sendError('TimeSheets not found.');
        }
   
        return $this->sendResponse(new TimeSheetsResource($time_sheets), 'TimeSheets retrieved successfully.');
    }
    
    public function update(Request $request, TimeSheets $time_sheets)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $time_sheets->name = $input['name'];
        $time_sheets->detail = $input['detail'];
        $time_sheets->save();
   
        return $this->sendResponse(new TimeSheetsResource($time_sheets), 'TimeSheets updated successfully.');
    }
   
    public function destroy(TimeSheets $time_sheets)
    {
        $time_sheets->delete();
   
        return $this->sendResponse([], 'TimeSheets deleted successfully.');
    }
}
