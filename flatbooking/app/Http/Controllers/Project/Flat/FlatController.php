<?php

namespace App\Http\Controllers\Project\Flat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Flat;
use App\Models\ComponyInfo;
use App\Models\Project;

class FlatController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:list flat', ['only' => ['index','show','unSoldFlat','soldFlat']]);
    //    // $this->middleware('permission:add flat', ['only' => ['create','store']]);
    //    // $this->middleware('permission:update flat', ['only' => ['edit','update']]);
    //    // $this->middleware('permission:flat view', ['only' => ['view']]);
    //    // $this->middleware('permission:flat delete', ['only' => ['delete']]);
    // }

    public function index(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flats = "";

            if ($request->sale_status || $request->start_date !== null && $request->end_date !== null) {
                
                if($request->start_date == null && $request->end_date == null){
                    $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    ->where('sale_status', $request->sale_status)
                    ->orderBy('id','desc')->paginate(15);
                }elseif($request->sale_status == null){
                    $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    ->where('sale_status', 2)
                    ->orderBy('id', 'desc')
                    ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })->paginate(15);
                }else{
                    $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    ->where('sale_status', 2)                    
                    ->where('sale_status', $request->sale_status)
                    ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })
                    ->orderBy('id', 'desc')->paginate(15);
                }
                
            } else {
                $flats = Flat::where('project_id', $project_id)->orderBy('id','desc')->paginate(15);
            }

            
            return view('Project-Panel.Flat.Flat_list', compact('flats'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function unSoldFlat(){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $project = Project::find($project_id);
            $flats = Flat::where('project_id', $project_id)->where('status', 0)->where('sale_status', 0)->orderBy('id','desc')->paginate(15);

            return view('Project-Panel.Flat.UnSold_flat', compact(['flats','project','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function soldFlat( Request $request ){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $project = Project::find($project_id);

            $flats = "";

            if ($request->start_date !== null && $request->end_date !== null) {
                $flats = Flat::where('project_id', $project_id)
                    ->where('status', 0)
                    ->where('sale_status', 2)
                    ->orderBy('id', 'desc')
                    ->when($request->start_date && $request->end_date, function (Builder $builder) use ($request) {
                        $builder->whereBetween(DB::raw('DATE(updated_at)'), [
                            $request->start_date,
                            $request->end_date,
                        ]);
                    })
                    ->paginate(20);
            } else {
                $flats = Flat::where('project_id', $project_id)->where('status', 0)->where('sale_status', 2)->orderBy('id','desc')->paginate(20);
            }            
            
            return view('Project-Panel.Flat.Sold_flat', compact(['flats','project','comInfo']));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }


    public function create(){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            return view('Project-Panel.Flat.Flat_add');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function store(Request $request){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $request->validate([
                'name' =>[ 'required'],
                'flat_area' =>[ 'required'],
                'price' =>[ 'required'],
                'floor' =>[ 'required'],
                // 'room' =>[ 'required'],
                // 'dining_space' =>[ 'required'],
                // 'bath_room' =>[ 'required'],
                // 'description' =>[ 'required'],
                // 'Parking' =>[ 'required'],
                // 'Outdoor' =>[ 'required'],
            ]);
            // dd($request->file('images'));
            $image=[];
            if ($request->hasFile('images')) {
                $files = $request->file('images');

                foreach( $files as $file){
                    $ImageName = 'Flat_'. time().'-'. mt_rand(100000, 100000000).'.'.$file->extension();
                    $file->move(public_path('upload/Flat'), $ImageName);

                    // return $ImageName;

                    $image[]= $ImageName;
                    
                }
            }
            
            $images = json_encode($image);
            // dd($images);

            $data = [
                'project_id' => $project_id,
                'name' => $request->name,
                'floor' => $request->floor,
                'flat_area' =>$request->flat_area,
                'price' =>$request->price,//Price/per Sqft
                'room' =>$request->room,
                'dining_space' =>$request->dining_space,
                'bath_room' =>$request->bath_room,
                'description' =>$request->description,
                'Parking' =>$request->Parking,
                'Outdoor' =>$request->Outdoor,
                'images'=>$images,
                'created_by' =>auth()->id(),
            ];

            Flat::create($data);

            return redirect()->route('flat.list')-> with('success','Flat Create Successful');

        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function edit($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){

            $flat = Flat::where('project_id', $project_id)->where('status', '!=', 1)->find($id);
            return view('Project-Panel.Flat.Flat_edit', compact('flat'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function update(Request $request, $id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $request->validate([
                'name' =>[ 'required'],
                'floor' => [ 'required'],
                'flat_area' =>[ 'required'],
                'price' =>[ 'required'],
                // 'room' =>[ 'required'],
                // 'dining_space' =>[ 'required'],
                // 'bath_room' =>[ 'required'],
                // 'description' =>[ 'required'],
                // 'Parking' =>[ 'required'],
                // 'Outdoor' =>[ 'required'],
            ]);

            //delete image
            $flat = Flat::where('project_id', $project_id)->findOrFail($id);
            if ($request->hasFile('images')) {
                $oldImages = $flat->images; 
                if(!empty($oldImages)){
                    if (is_string($oldImages)) {
                        $oldImages = json_decode($oldImages, true); 
                    }
                    foreach ($oldImages as $oldImage) {
                        $oldImagePath = public_path('upload/Flat/' . $oldImage);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
                $flat->update(['images' => null]);
            }

            //Update Image
            $image=[];
            if ($request->hasFile('images')) {
                $files = $request->file('images');

                foreach( $files as $file){
                    $ImageName = 'Flat_'. time().'-'. mt_rand(100000, 100000000).'.'.$file->extension();
                    $file->move(public_path('upload/Flat'), $ImageName);

                    $image[]=[
                         $ImageName,
                    ];
                }
            }
            $images = json_encode($image);            

            $data = [
                'project_id' => $project_id,
                'name' => $request->name,
                'floor' => $request->floor,
                'flat_area' =>$request->flat_area,
                'price' =>$request->price,
                'room' =>$request->room,
                'dining_space' =>$request->dining_space,
                'bath_room' =>$request->bath_room,
                'description' =>$request->description,
                'Parking' =>$request->Parking,
                'Outdoor' =>$request->Outdoor,
                'updated_by' =>auth()->id(),
            ];

            $flat->update($data);
            if($request->hasFile('images')){
                $flat->update(['images'=>$images,]);
            }

            return redirect()->route('flat.list')-> with('success','Flat Update Successful');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function view($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $comInfo = ComponyInfo::first();
            $flat = Flat::where('project_id', $project_id)->find($id);

            return view('Project-Panel.Flat.Flat_view', compact('flat','comInfo'));
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }

    public function delete($id){
        $project_id = Session::get('project_id');
        if($project_id !== null){
            $flat = Flat::where('project_id', $project_id)->findOrFail($id);
            $flat->delete();
            return redirect()->route('flat.list')-> with('success','Flat Delete Successful');
        }else{
            return redirect()->route('list.project')-> with('error','Project Id Is Null');
        }
    }
}
