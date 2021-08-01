<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class AuthorHomeController extends Controller
{
    public function Index(){
        $blogPosts = BlogPost::latest()->limit(3)->where('status', 1)->get();
        return view('author.index', compact('blogPosts'));
    }







    public function ShowAllBlogPost(){
        $blogPosts = BlogPost::latest()->where('status', 1)->paginate(20);
        return view('author.blog',compact('blogPosts'));
    }








    public function ViewPostDetails($slug){
        $postDetails = BlogPost::where('slug', $slug)->get();

        $id = BlogPost::where('slug', $slug)->value('id');
        $comments =Comment::latest()->where('blog_id', $id)->where('status', 1)->get();
        return view('author.blog-details', compact('postDetails','comments'));
    }












    public function CommentStore(Request $request, $id){


        $validation = $request->validate([
            'first_name' => 'required',
            'message'=>'required'
        ]);


        $comments = new Comment();

        $comments->blog_id = $id;
        $comments->email = $request->email;
        $comments->first_name = $request->first_name;
        $comments->last_name = $request->last_name;
        $comments->message = $request->message;
        $comments->status = 0;

        $comments->save();
        if ( $comments == true ){
            $notifications = alert()->success('SuccessAlert','Thank you for you valuable comment.');
            return redirect()->back();
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }













    public function DisplayMyBlog(){
        $blogs = BlogPost::where('created_by', Auth::user()->id)->latest()->paginate(15);
        return view('author.my-blog',compact('blogs'));
    }




















    public function AddPost(){
        $categories = Category::get();
        return view('author.create-blog', compact('categories'));
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
            $notifications = alert()->success('SuccessAlert','Your post are published');
            return redirect('/author/my-blog');
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return redirect('/author/my-blog');
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
            $notifications = alert()->success('SuccessAlert','Your post status are updated');
            return response()->json($notifications);
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return response()->json($notifications);
        }
    }














    public function Edit($id){
        $categories = Category::get();
        $blogPostData = BlogPost::find($id);
        return view('author.edit-blog',compact('blogPostData','categories'));
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
            $notifications = alert()->success('SuccessAlert','Your post are published');
            return redirect('/author/my-blog');
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return redirect('/author/my-blog');
        }
    }






    public function View($id){
        $viewPost = BlogPost::findOrFail($id);

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
            $notifications = alert()->success('SuccessAlert','Post deleted successfully');
            return Redirect()->back();
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return Redirect()->back();
        }

    }


}
