<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\TimeSheets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\TimeSheet as TimeSheetsResource;
   
class TimeSheetController extends BaseController
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'project_id' => 'required|numeric',
            'name_client' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'hours_per_week' => 'required|numeric',
            'total_time' => 'required|numeric',
            'date' => 'required|date',
            'user' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $timesheet = TimeSheets::create($input);

        if ($timesheet->exists()) {
            return(new TimeSheetResource($timesheet))->response()->setStatusCode(201);
        }
    }

    
    


    
}
