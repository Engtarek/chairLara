<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;

use App\Employees;

class EmployeeController extends Controller
{
    //display all employees
    public function index(){
      return view('admin.employees.index');
    }

    //show add employee form
    public function create(){
      return view('admin.employees.create');
    }
    //save new employee in database
    public function store(Request $request){
      $this->validate($request,[
        'name' => 'required',
        'title' => 'required',
        'phone' => 'required',
        'email' => 'required',
      ]);

      Employees::create($request->all());
     return redirect()->route("employees.index")->with("success","The employee created successfully");
    }

    //show form to delete&edit emoloyee
    public function show($id)
    {
      $employee = Employees ::find($id);
      return view('admin.employees.view',compact('employee'));
    }

    //delete employee
    public function destroy($id)
    {
        $employee = Employees::find($id);
        $employee->delete();
        return redirect()->route("employees.index")->with("success","The employee deleted successfully");
    }

    //edit exiting employee
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
        'title' => 'required',
        'phone' => 'required',
        'email' => 'required',
      ]);
       $employee = Employees::find($id);
      $employee->update($request->all());
      return redirect()->route("employees.show",$id)->with("success","The employee updated successfully");

    }
      //datatables
    public function data(){
      $employee = Employees::all();
      return DataTables::of($employee)

      ->editColumn('name',function($model){
        return $model->name;
       })
       ->editColumn('title',function($model){
            return $model->title;
       })
       ->editColumn('phone',function($model){
         return $model->phone;
        })
        ->editColumn('email',function($model){
             return $model->email;
        })
      ->editColumn('view',function($model){
        return \Html::link('/admin/employees/'.$model->id,'view');
      })
      ->make(true);
    }
}
