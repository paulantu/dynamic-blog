@extends('admin.master')
@section('title', 'Blog Post')
@section('admin_content')

    <div class="flex flex-wrap pr-8">
        <div class="p-10">

            <div class="min-w-lg rounded shadow-lg">
                <h2 class="p-6 text-2xl">Edit Blog Post</h2>


                <form class="mt-8 mr-6 mb-16 ml-6" action="{{ url('admin/update/blog-post/'.$blogPostData->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="grid grid-cols-3 gap-4">
                        <div class="">
                            <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Post Title
                            </label>
                            <input type="text" name="title" value="{{ $blogPostData->title }}" id="title" placeholder="enter post title" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>


                        <div class="">
                            <label for="cat_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Category
                            </label>
                            <select name="cat_id" id="cat_id" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full">
                                    <option value="">{{ $blogPostData->category->cat_name }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="">
                            <label for="sub_cat_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Sub Category
                            </label>
                            <select name="sub_cat_id" id="sub_cat_id" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full">
                                @if($blogPostData->sub_cat_id == true)
                                    <option value="">{{ $blogPostData->sub_category->subcat_name }}</option>
                                @else
                                @endif
                            </select>
                        </div>

                    </div>

                    <div class="mt-8">
                        <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold">
                            Description
                        </label>
                    </div>
                    <div class="flex w-full flex-wrap items-stretch mb-3 mt-2">
                        <textarea class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10" name="description"
                                  id="description" aria-describedby="description" placeholder="enter description">

                            {{ $blogPostData->description }}
                        </textarea>
                    </div>

                    <div class="mt-8 mb-3">
                        <label for="summary" class="block uppercase tracking-wide text-gray-700 text-xs font-bold">
                            Summary
                        </label>
                    </div>
                    <div class="flex w-full flex-wrap items-stretch mb-2">
                       <textarea class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10" name="summary"
                                 id="summary" aria-describedby="summary" placeholder="enter summary">
                           {{ $blogPostData->summary }}
                        </textarea>
                    </div>


                    <div class="py-5 bg-white px-2">
                        <label for="images" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Upload images
                        </label>
                        <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                            <div class="md:flex">
                                <div class="w-full p-3">
                                    <div class="relative border-dotted h-24 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center"> <i class="fa fa-folder-open fa-4x text-blue-700"></i> <span class="block text-gray-400 font-normal">Attach you files here</span> </div>
                                        </div> <input type="file" class="h-full w-full opacity-0" name="images[]" id="images" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach(json_decode($blogPostData->images) as $image)
                            <div class="flex">
                            <img src="{{ asset($image) }}" alt="blog images" width="80px" height="50px" class="ml-2 mr-2">
                            </div>
                        @endforeach
                    </div>


                    <div class="mb-6 mt-6">
                        <label for="status" class="inline-flex items-center">
                            <input type="checkbox" name="status" id="status" value="1" class="form-checkbox text-green-500" {{ $blogPostData->status ? 'checked' : '' }}>
                            <span class="ml-2">do you want to publish?</span>
                        </label>
                    </div>

                    <button class="mb-10 bg-green-500 text-gray-500 active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        //add product subcategory dependency dropdown start


        $(document).ready(function(){
            $('select[name="cat_id"]').on('change', function(){
                var cat_id = $(this).val();
                if(cat_id) {
                    jQuery.ajax({
                        url:'/subCatdependency/' + cat_id,
                        type: "GET",
                        dataType: "json",

                        success:function(data){
                            $('select[name="sub_cat_id"]').empty('select sub category');
                            jQuery.each(data, function(key, value){
                                $('select[name="sub_cat_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }
                else{
                    // $('select[name="subcat_id"]').empty();
                    alert('danger');
                }
            });
        });

        //add product subcategory dependency dropdown end


    </script>

@endsection
