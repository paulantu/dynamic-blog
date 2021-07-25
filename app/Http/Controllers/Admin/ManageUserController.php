<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function Index(){
        $users = User::latest()->paginate(20);
        $roles = Role::get();
        return view('admin.user', compact('users','roles'));
    }



    public function userRoleUpdate(Request $request, $id){
        $roleStatus = User::where('id', $id)->update(['role_id'=>$request->role_id]);

        if($roleStatus == true){
            $notification = array(
                'message' => 'User role updated',
                'alert-type' => 'success'
            );
            return response()->json($notification);
        }else{
            $notification = array(
                'message' => 'Somethings went wrong',
                'alert-type' => 'error'
            );
            return response()->json($notification);
        }
    }







    public function changeStatus(Request $request){
        $user = User::find($request->id);

        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        if($user == true){
            $notification = array(
                'message' => 'User ststus updated',
                'alert-type' => 'success'
            );
            return response()->json($notification);
        }else{
            $notification = array(
                'message' => 'Somethings went wrong',
                'alert-type' => 'error'
            );
            return response()->json($notification);
        }
    }













    public function Destroy($id){
        // find the data row
        $destroy = User::findOrFail($id);
        $destroy -> forceDelete();
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
