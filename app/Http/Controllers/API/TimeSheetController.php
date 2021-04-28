<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\TimeSheets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\TimeSheets as TimeSheetsResource;
   
class TimeSheetController extends BaseController
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'client_id' => 'required',
            'project_id' => 'required',
            'name_client' => 'required',
            'project' => 'required',
            'description' => 'required',
            'hours_per_week' => 'required',
            'total_time' => 'required',
            'date' => 'required',
            'user' => 'required'
        ]);

    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['token'] = Str::random(100);
        $timesheet = TimeSheets::create($input);

        return $this->sendResponse(['token' => $timesheet->token], "TimeSheet created");
    }

    
    


    
}
