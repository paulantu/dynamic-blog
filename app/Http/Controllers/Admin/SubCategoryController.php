<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }







    public function Index(){
        $categories = Category::get();
        $subCategories = Subcategory::latest()->paginate(15);
        return view('admin.sub-category', compact('categories','subCategories'));
    }









    public function Store(Request $request){
        $validation = $request->validate([
            'cat_name'=>'required',
            'sub_cat_name'=>'required',
        ]);
        $SubCategories = new Subcategory();

        $SubCategories->cat_id = $request->cat_name;
        $SubCategories->subcat_name = $request->sub_cat_name;
        $SubCategories->subcat_meta_title = Str::lower($request->sub_cat_name);
        $SubCategories->created_by = Auth::user()->id;
        $SubCategories->status = 1;
        $SubCategories->slug = Str::slug($request->sub_cat_name, '-');

        $SubCategories->save();

        if($SubCategories){
            $notification = array(
                'message' => 'sub category added successfully',
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
        $subCategory = Subcategory::find($request->id);

        if($subCategory->status == 1){
            $subCategory->status = 0;
        }else{
            $subCategory->status = 1;
        }
        $subCategory->save();
        if($subCategory == true){
            $notification = array(
                'message' => 'sub category status updated',
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
        $categories = Category::get();
        $subCategory_datas = Subcategory::find($id);
        return view('admin.edit-sub-category',compact('subCategory_datas', 'categories'));
    }









    public function Update(Request $request){
        $validation = $request->validate([
            'cat_name' => 'required',
            'sub_cat_name'=>'required'
            ]);

        $updateCategory = Subcategory::find($request->id);


        $updateCategory->cat_id = $request->cat_name;
        $updateCategory->subcat_name = $request->sub_cat_name;
        $updateCategory->subcat_meta_title = Str::lower($request->cat_name);
        $updateCategory->created_by = Auth::user()->id;
        $updateCategory->status = 1;
        $updateCategory->slug = Str::slug($request->sub_cat_name, '-');

        $updateCategory->save();
        if ($updateCategory == true){
            $notification = array(
                'message' => 'sub category updated successfully',
                'alert-type' => 'success'
            );
            return redirect('admin/sub-category')->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect('admin/sub-category')->with($notification);
        }

    }









    public function Destroy($id){
        // find the data row
        $delete = Subcategory::findOrFail($id);
        $destroy = $delete-> forceDelete();
        if($destroy){
            $notification = array(
                'message' => 'sub category deleted successfully',
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
