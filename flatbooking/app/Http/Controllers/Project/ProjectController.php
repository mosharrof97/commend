<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Project;
use App\Models\ComponyInfo;
use App\Models\Investment;


class ProjectController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:view project', ['only' => ['index']]);
    //     $this->middleware('permission:create project', ['only' => ['create','store']]);
    //     $this->middleware('permission:update project', ['only' => ['edit','update']]);
    //     $this->middleware('permission:view project', ['only' => ['view']]);
    //     $this->middleware('permission:delete project', ['only' => ['delete']]);
    // }


    public function index(){
        $projects = Project::where('status',0)->get();
        return view('Admin-Panel.page.Project.Project_List',compact('projects'));
    }

    public function create(Request $request){
        $districts = District::get();
        return view('Admin-Panel.page.Project.New_project', compact('districts'));
    }

    // public function projectCreateAPI(){

    // }

    public function store(Request $request){
        $test = $request->validate([
            'projectName' =>[ 'required','string'],
            // 'budget' =>[ 'required'],
            // 'land_area' =>[ 'required'],
            // 'front_road'=>[ 'required'],
            // 'duration' =>[ 'required'],
            // 'floor' =>[ 'required'],
            // 'flat' =>[ 'required'],
            // 'comm_space_size' =>[ 'required'],
            // 'num_of_basement' =>[ 'required'],
            // 'start_date' =>[ 'required'],
            // 'end_date' =>[ 'required'],
            // 'address' =>[ 'required','string'],
            // 'city' =>[ 'required','string'],
            // 'district_id' =>[ 'required'],
            // 'zipCode' =>[ 'required'],
            // 'image' =>[ 'required','image'],
        ]);


        if($request->hasFile('image')){
            $imageName = 'Project_' . time().'-'.mt_rand(1000000,10000000000).'.'.$request->file('image')->extension();
            $request->image->move(public_path('upload/Project'), $imageName);
        }

        $data=[
            'projectName' =>$request->projectName,
            'budget' =>$request->budget,
            'land_area' =>$request->land_area,
            'front_road' =>$request->front_road,
            'duration' =>$request->duration,
            'floor' =>$request->floor,
            'flat' =>$request->flat,
            'comm_space_size' =>$request->comm_space_size,
            'num_of_basement' =>$request->num_of_basement,
            'start_date' =>$request->start_date,
            'end_date' =>$request->end_date,
            'address' =>$request->address,
            'city' =>$request->city,
            'district_id' =>$request->district_id,
            'zipCode' =>$request->zipCode,
            'image' => $imageName ?? 'null',
        ];

        Project::create($data);
        return redirect()->route('list.project')->with('message','Create Project Successful');
    }

    public function view($id){
        $project = Project::where('status',0)->where('id', $id)->first();
        $comInfo = ComponyInfo::firstOrFail(); 
        $investment = Investment::where('project_id', $project->id)->get();
        //return $investment;
        return view('Admin-Panel.page.Project.Project_View', compact(['project', 'comInfo', 'investment']));
    }

    public function edit($id){
        $data=[
            'project' => Project::where('status',0)->where('id', $id)->first(),
            'districts' => District::get(),
        ];
        return view('Admin-Panel.page.Project.edit_project', $data);
    }

    public function update(Request $request, $id){

        $request->validate([
            'projectName' =>[ 'required','string'],
            // 'budget' =>[ 'required'],
            // 'land_area' =>[ 'required'],
            // 'front_road' =>[ 'required'],
            // 'duration' =>[ 'required'],
            // 'floor' =>[ 'required'],
            // 'flat' =>[ 'required'],
            // 'comm_space_size' =>[ 'required'],
            // 'num_of_basement' =>[ 'required'],
            // 'start_date' =>[ 'required'],
            // 'end_date' =>[ 'required'],
            // 'address' =>[ 'required','string'],
            // 'city' =>[ 'required','string'],
            // 'district_id' =>[ 'required'],
            // 'zipCode' =>[ 'required'],
            // 'status' =>[ 'required'],
            // 'image' =>[ 'required'],
        ]);
        
        $project = Project::where('status',0)->find($id);
        if ($request->hasFile('image')) {
            $oldImages = $project->image; 
            if(!empty($oldImage)){                    
                    $oldImagePath = public_path('upload/Flat/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
            }            
            $project->update(['image' => null]);
        }

        if($request->hasFile('image')){
            $imageName = 'Project_' . time().'-'.mt_rand(1000000,10000000000).'.'.$request->image->extension();
            $request->image->move(public_path('upload/Project'), $imageName);
        }

        $data=[
            'projectName' =>$request->projectName,
            'budget' =>$request->budget,
            'land_area' =>$request->land_area,
            'front_road' =>$request->front_road,
            'duration' =>$request->duration,
            'floor' =>$request->floor,
            'flat' =>$request->flat,
            'comm_space_size' =>$request->comm_space_size,
            'num_of_basement' =>$request->num_of_basement,
            'start_date' =>$request->start_date,
            'end_date' =>$request->end_date,
            'address' =>$request->address,
            'city' =>$request->city,
            'district_id' =>$request->district_id,
            'zipCode' =>$request->zipCode,
            'status' =>$request->status,            
            'updated_by'=>auth()->id(),
        ];

        $project->update($data);
        if($request->hasFile('image')){
            $project->update(['image' => $imageName,]);
        }
        return redirect()->route('list.project')->with('message','Project Update Successful');
    }

    public function delete($id) {
        $client = Project::findOrFail($id);
        $client->delete();
        
        return redirect()->route('list.project')->with('message','Project Delete Successful');
    }

    public function restore($id) {
        $client = Project::withTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('client.list')->with('message','Project Restore Successfully');
    }
}
