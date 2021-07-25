<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class ManageRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function Index(){
        $roles = Role::latest()->paginate(10);
        return view('admin.role', compact('roles'));
    }






    public function Store(Request $request){
        $validation = $request->validate(['name' => 'required']);

        $store_role = new Role();

        $store_role->name = $request->name;
        $store_role->save();
        if ($store_role == true){
            $notification = array(
                'message' => 'A new role aded.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }







    public function Edit($id){
        $role_datas = Role::find($id);
        return view('admin.role-edit',compact('role_datas'));
    }










    public function Update(Request $request){
        $validation = $request->validate(['name' => 'required']);

        $update_role = Role::find($request->id);

        $update_role->name = $request->name;
        $update_role->save();
        if ($update_role == true){
            $notification = array(
                'message' => 'Role updated successfully',
                'alert-type' => 'success'
            );
            return redirect('admin/manage-role')->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect('admin/manage-role')->with($notification);
        }

    }









    public function Destroy($id){
        // find the data row
        $delete = Role::findOrFail($id);
        $destroy = $delete-> forceDelete();
        if($destroy){
            $notification = array(
                'message' => 'data deleted successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }


}
