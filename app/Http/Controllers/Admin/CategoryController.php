<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }







   public function Index(){
       $categories = Category::latest()->paginate(15);
       return view('admin.category', compact('categories'));
   }









    public function Store(Request $request){
            $validation = $request->validate([
                'cat_name'=>'required'
            ]);
        $categories = new Category();

        $categories->cat_name = $request->cat_name;
        $categories->cat_meta_title = Str::lower($request->cat_name);
        $categories->created_by = Auth::user()->id;
        $categories->status = 1;
        $categories->slug = Str::slug($request->cat_name, '-');

        $categories->save();

        if($categories){
            $notification = array(
                'message' => 'Category added successfully',
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










    public function changeStatus(Request $request){
        $categoryStatus = Category::find($request->id);

        if($categoryStatus->status == 1){
            $categoryStatus->status = 0;
        }else{
            $categoryStatus->status = 1;
        }
        $categoryStatus->save();
        if($categoryStatus == true){
            $notification = array(
                'message' => 'category status updated',
                'alert-type' => 'success'
            );
            return response()->json($notification);
        }else{
            $notification = array(
                'message' => 'somethings went wrong',
                'alert-type' => 'error'
            );
            return response()->json($notification);
        }
    }











    public function Edit($id){
        $category_datas = Category::find($id);
        return view('admin.edit-category',compact('category_datas'));
    }









    public function Update(Request $request){
        $validation = $request->validate(['cat_name' => 'required']);

        $updateCategory = Category::find($request->id);


        $updateCategory->cat_name = $request->cat_name;
        $updateCategory->cat_meta_title = Str::lower($request->cat_name);
        $updateCategory->created_by = Auth::user()->id;
        $updateCategory->status = 1;
        $updateCategory->slug = Str::slug($request->cat_name, '-');

        $updateCategory->save();
        if ($updateCategory == true){
            $notification = array(
                'message' => 'category updated successfully',
                'alert-type' => 'success'
            );
            return redirect('admin/category')->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect('admin/category')->with($notification);
        }

    }









    public function Destroy($id){
        // find the data row
        $delete = Category::findOrFail($id);
        $destroy = $delete-> forceDelete();
        if($destroy){
            $notification = array(
                'message' => 'category deleted successfully',
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
