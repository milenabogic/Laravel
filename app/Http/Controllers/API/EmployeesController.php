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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'status' => 'required|string',
            'role' => 'required|string',
            'hours_per_week' => 'required',
            "token" => 'string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

       try {
        $input = $request->all();   
        $employee = Employees::create($input);
        if($employee->save()) {
            error_log('The employee was successfully created.');
        }
        $employee->token = Str::random(100);
        if($employee->token) {
            error_log("Token is: " .$employee->token);
        }
        return $this->sendResponse(['token' => $employee->token], "The employee was successfully created: " .$employee->name);
        }
        catch(\Exception $e){
            error_log('Problem. The employee is can not be created.');
            echo $e->getMessage();  
         }
    }

    public function login(Request $request)
    {    //'password' => $request->password treba dodati pored email-a kada u tabeli imamo password
        if(Auth::attempt(['email' => $request->email])){
            $employee = Auth::employee();
            $employee['token'] =  $employee->createToken('MyApp')-> accessToken;
            $employee['name'] =  $employee->name;

            return $this->sendResponse($success, 'Employee login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

   /* public function list_all_employees() {
        return Employees::all(); // vraca kolekciju, navodi sve kolone iz tabele
    }*/

    public function one_employee($id) {
        return Employees::find($id);
    }

    public function search($name) {
        return Employees::where("name" ,$name)->get();
    }

    
}
