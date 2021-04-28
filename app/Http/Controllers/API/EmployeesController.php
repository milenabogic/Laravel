<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\Employees as EmployeesResource;
   
class EmployeesController extends BaseController
{
    public function insert() {
        $urlData = getURLList();
        return view('employee_create');
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'status' => 'required|string',
            'role' => 'required|string',
            'hours_per_week' => 'required',
            'token' => 'string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
       
        $input = $request->all();   
        $employee = Employees::create($input);
        $employee->save();
        $employee->token = Str::random(100);
        
        return $this->sendResponse(['token' => $employee->token], "The employee was successfully created: " .$employee->name);
        } 
    

    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email])) {
            $employee = Auth::employee();
            $employee['token'] =  $employee->createToken('MyApp')-> accessToken;
            $employee['name'] =  $employee->name;
            return $this->sendResponse($success, 'Employee login successfully.');
            }

        else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
    }

    public function list_all_employees() {
        return Employees::all();
    }

    public function one_employee($id) {
        return Employees::find($id);
    }

    public function search($name) {
        return Employees::where("name" ,$name)->get();
    }

    public function update (Request $request) {

        $employee = Employees::find($request->id);
        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->email = $request->email;
        $employee->status = $request->status;
        $employee->role = $request->role;
        $employee->hours_per_week = $request->hours_per_week;
        $result = $employee->save();

        if($result) {
            return ["result" => "Data has been updated."];
        }

        else {
            return ["result" => "Data hasn't been updated."];
        }
    }

    public function delete ($id) {
        $employee = Employees::find($id);
        $result = $employee->delete();

        if($result) {
            return ["result" => "Employee has been deleted."];
        }

        else {
            return ["result" => "Error. Employee hasn't been deleted."];
        }
    }
    
  }

