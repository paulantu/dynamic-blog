<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function Index(){
        $blogs = BlogPost::latest()->paginate(15);
        return view('admin.blog', compact('blogs'));
    }











    public function AddPost(){
        $categories = Category::get();
        return view('admin.add-blog-post', compact('categories'));
    }














    public function subCatdependency($cat_id){
        $data = Subcategory::where('cat_id', $cat_id)->pluck('subcat_name', 'id');
        return json_encode($data);
    }











    public function Store(Request $request){
        $validation = $request->validate([
            'title' => 'required',
            'cat_id'=>'required',
            'description'=>'required',
        ]);
        $blogPosts = new BlogPost();

        $blogPosts->title = $request->title;
        $blogPosts->cat_id = $request->cat_id;
        $blogPosts->sub_cat_id = $request->sub_cat_id;
        $blogPosts->created_by = Auth::user()->id;
        $blogPosts->meta_title = Str::lower($request->title);
        $blogPosts->slug = Str::slug($request->title, '-');
        $blogPosts->description = $request->description;
        $blogPosts->summary = $request->summary;

        $images = $request->file('images');
        if($images == true){
            foreach ($images as $image) {
                $name_image_one = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800, 500)->save('image/post/' . $name_image_one);
                $imageNames[] = 'image/post/' . $name_image_one;
            }
            $blogPosts_images = json_encode($imageNames);
            $blogPosts->images = $blogPosts_images;
        }
        $blogPosts->status = $request->status;
        $blogPosts->save();

        if($blogPosts){
            $notification = array(
                'message' => 'blog post added successfully',
                'alert-type' => 'success'
            );
            return redirect('/admin/blog')->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect('/admin/blog')->with($notification);
        }
    }















    public function changeStatus(Request $request){
        $blogPostStatus = BlogPost::find($request->id);

        if($blogPostStatus->status == 1){
            $blogPostStatus->status = 0;
        }else{
            $blogPostStatus->status = 1;
        }
        $blogPostStatus->save();
        if($blogPostStatus == true){
            $notification = array(
                'message' => 'blog post status updated',
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
        $blogPostData = BlogPost::find($id);
        return view('admin.edit-blog-post',compact('blogPostData','categories'));
    }












    public function Update(Request $request){
        $validation = $request->validate([
            'title' => 'required',
            'cat_id'=>'required',
            'description'=>'required'
        ]);
        $updateBlogPosts = BlogPost::find($request->id);

        $updateBlogPosts->title = $request->title;
        $updateBlogPosts->cat_id = $request->cat_id;
        $updateBlogPosts->sub_cat_id = $request->sub_cat_id;
        $updateBlogPosts->created_by = Auth::user()->id;
        $updateBlogPosts->meta_title = Str::lower($request->title);
        $updateBlogPosts->slug = Str::slug($request->title, '-');
        $updateBlogPosts->description = $request->description;
        $updateBlogPosts->summary = $request->summary;

        $images = $request->file('images');
        if($images == true){
            // for checking existing file and delete.
            $blogImage = json_decode($updateBlogPosts->images);
            foreach($blogImage as $image){
                if (file_exists(public_path($image))) {
                    File::delete($image);
                }
            }


//            for new file upload
            foreach ($images as $image) {
                $name_image_one = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800, 500)->save('image/post/' . $name_image_one);
                $imageNames[] = 'image/post/' . $name_image_one;
            }
            $blogPosts_images = json_encode($imageNames);
            $updateBlogPosts->images = $blogPosts_images;
        }
        $updateBlogPosts->status = $request->status;
        $updateBlogPosts->save();

        if($updateBlogPosts){
            $notification = array(
                'message' => 'blog post updated successfully',
                'alert-type' => 'success'
            );
            return redirect('/admin/blog')->with($notification);
        }else{
            $notification = array(
                'message' => 'something went wrong',
                'alert-type' => 'error'
            );
            return redirect('/admin/blog')->with($notification);
        }
    }






    public function View($id){
        $viewPost = BlogPost::findOrFail($id);
//        $shareComponent = \Share::page(
//            'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
//            'Your share text comes here'
//        )
//            ->facebook()
//            ->twitter()
//            ->linkedin()
//            ->telegram()
//            ->whatsapp()
//            ->reddit();

        return view('admin.view-blog', compact('viewPost'));
    }





    public function Destroy($id){
        // find the data row
        $delete = BlogPost::findOrFail($id);
        // find & delete file from location
        $blogImage = json_decode($delete->images);
        foreach($blogImage as $image){
            if (file_exists(public_path($image))) {
                File::delete($image);
            }
        }
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
