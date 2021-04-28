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
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'client_id' => 'required',
            'project' => 'required',
            'name_client' => 'required',
            'name_employee' => 'required',
            'status_project' => 'required',
            'archived_project' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['token'] = Str::random(100);
        $project = Projects::create($input);

        return $this->sendResponse(['token' => $project->token], "Project created");
    }

    public function list_all_projects() {
        return Projects::all();
    }

    public function one_project($id) {
        return Projects::find($id);
    }

    public function search($project) {
        return Projects::where("project" ,$project)->get();
    }

    public function update (Request $request) {

        $project = Projects::find($request->id);
        $project->project = $request->project;
        $project->employee_id = $request->employee_id;
        $project->client_id = $request->client_id;
        $project->name_client = $request->name_client;
        $project->name_employee = $request->name_employee;
        $project->status_project = $request->status_project;
        $project->archived_project = $request->archived_project;
        $result = $project->save();

        if($result) {
            return ["result" => "Data has been updated."];
        }

        else {
            return ["result" => "Data hasn't been updated."];
        }
    }

    public function delete ($id) {
        $project = Projects::find($id);
        $result = $project->delete();

        if($result) {
            return ["result" => "Project has been deleted."];
        }

        else {
            return ["result" => "Error. Project hasn't been deleted."];
        }
    }
    
}
