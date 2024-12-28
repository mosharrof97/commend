<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\District;
use App\Models\EmployeeAddress;
use DB;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:list employee', ['only' => ['index','view']]);
    //     $this->middleware('permission:create employee', ['only' => ['create','store','update','edit']]);
    //     $this->middleware('permission:delete employee', ['only' => ['destroy']]);
    // }

    public function index() {
        $employee = Employee::where('status', '!=', 1)->get();
        return view('Admin-Panel.page.Employee.employee_list', ['employees' => $employee]);
    }

    public function create() {
        // $roles = Role::pluck('name','name')->all();
        $districts = District::get();
        return view('Admin-Panel.page.Employee.employee', ['districts'=>$districts]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'gender' => 'required',
            'phone' => 'required|max:255|unique:employees,phone',
            'email' => 'required|email|max:255|unique:employees,email',
            'nid' => 'required',
            'nationality' => 'required',
            'designation' => 'required',
            'join_date' => 'required',
            'image' => 'required',

            'pre_address' => 'required|string|max:255',
            'pre_city' => 'required|string|max:255',
            'pre_district' => 'required|string|max:255',
            'pre_zipCode' => 'required',

            'per_address' => 'required|string|max:255',
            'per_city' => 'required|string|max:255',
            'per_district' => 'required|string|max:255',
            'per_zipCode' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'Employee_' . time() . '_' . mt_rand(100000, 9999999999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('upload/employee'), $imageName);
        }

        // dd(auth()->id());
        try {
            DB::beginTransaction();
            $employee = Employee::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'nid' => $request->nid,
                'nationality' => $request->nationality,
                'join_date' => $request->join_date,
                'designation' => $request->designation,
                'image'=> $imageName ?? 'No Image',
                'created_by' => auth()->id(),
            ]);

            EmployeeAddress::create([
                'employee_id' => $employee->id,
                'pre_address' => $request->pre_address,
                'pre_city' => $request->pre_city,
                'pre_district' => $request->pre_district,
                'pre_zipCode' => $request->pre_zipCode,

                'per_address' => $request->per_address,
                'per_city' => $request->per_city,
                'per_district' => $request->per_district,
                'per_zipCode' => $request->per_zipCode,
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('employee.list')->with('status','User created successfully with roles');
    }

    public function edit(Request $request, $id) {
        $districts = District::get();
        $employee = Employee::where('status', '!=', 1)->find($id);

        return view('Admin-Panel.page.Employee.employee_edit', [
            'employee' => $employee,
            'districts' => $districts,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required',
            'phone' => 'required|max:255',
            'nid' => 'required',
            'email' => 'required|email|max:255',
            'designation' => 'required',
            // 'image' => 'required',

            'pre_address' => 'required|string|max:255',
            'pre_city' => 'required|string|max:255',
            'pre_district' => 'required|string|max:255',
            'pre_zipCode' => 'required',

            'per_address' => 'required|string|max:255',
            'per_city' => 'required|string|max:255',
            'per_district' => 'required|string|max:255',
            'per_zipCode' => 'required',
        ]);

        // $data = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     // 'nid' => $request->nid,
        //     // 'role_id' => $request->role_id,
        //     // 'password' => Hash::make($request->password),
        //     // 'image'=> $imageName,
        // ];



        try {
            DB::beginTransaction();

            if($request->hasFile('image')){
                $imageName = "Employee_" . time() .'_'. mt_rand(100000,1000000000) .'.'. $request->File('image')->extension();
                $request->file('image')->move(public_path('upload/Employee'),$imageName);
            }
            $employee = Employee::where('status', '!=', 1)->find($id);
            $employee->update([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'nid' => $request->nid,
                'designation' => $request->designation,
                'image'=> $imageName ?? 'No Image',
                'updated_by' => auth()->id(),
            ]);
            $address = EmployeeAddress::where('employee_id', $id)->first();

            $address->update([
                // 'employee_id' => $employee->id,
                'pre_address' => $request->pre_address,
                'pre_city' => $request->pre_city,
                'pre_district' => $request->pre_district,
                'pre_zipCode' => $request->pre_zipCode,

                'per_address' => $request->per_address,
                'per_city' => $request->per_city,
                'per_district' => $request->per_district,
                'per_zipCode' => $request->per_zipCode,
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('employee.list')->with('status','User Updated Successfully with roles');
    }

    public function view($Id) {
        $employee = Employee::where('status', '!=', 1)->find($Id);

        return view('Admin-Panel.page.Employee.employee_details',['employee' => $employee]);
    }

    public function destroy($employeeId) {

        $employee = Employee::where('status', '!=', 1)->findOrFail($employeeId);
        // $employee->deleted_by = auth()->id();
        // $employee->save();

        $employee->update([
            'status'=> 1,
        ]);

        return redirect()->route('employee.list')->with('status','User Delete Successfully');
    }
}
