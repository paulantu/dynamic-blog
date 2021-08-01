@extends('author.master')
@section('content')
    <style>
        input:checked ~ .dot {
            transform: translateX(100%);
            background-color: #48bb78;
        }
    </style>
    <section class="container mx-auto py-6 mt-16 mb-12">
    <div class="flex flex-wrap mt-8 pr-8 object-right">
        <a href="{{ url('author/add/blog-post') }}" class="ml-4 bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
            add post
        </a>
    </div>

    <div class="flex flex-wrap mt-4 ml-4">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table-auto divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-gray-600">
                        @foreach($blogs as $blog)
                            <tr>
                                @php
                                    $image = json_decode($blog->images);
                                    $thumbnail = $image[0];
                                @endphp
                                <td class="px-6 py-4 whitespace-nowrap ">{{ $blogs->firstItem()+$loop->index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><img src="{{ asset($thumbnail) }}" alt=""post thumbnail width="100px" height="100px"></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $blog->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $blog->category->cat_name }}<br><hr>
                                    @if($blog->sub_cat_id == true)
                                        {{ $blog->sub_category->subcat_name }}
                                    @else
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{!! Str::limit(html_entity_decode($blog->description), 100) !!}</td>
                                <td class="">
                                    <div class="flex items-center justify-center w-full mt-1">

                                        <label for="toggle{{ $blog->id }}" class="flex items-center cursor-pointer">
                                            <!-- toggle -->
                                            <div class="relative">
                                                <!-- input -->
                                                <input type="checkbox" data-id="{{$blog->id}}" title="{{ $blog->id }}" onchange="changeStatus(this.title)"
                                                       id="toggle{{ $blog->id }}" class="sr-only" class="toggle-status" data-onstyle="success" data-offstyle="danger"
                                                       data-toggle="toggle" data-on="Active" data-off="InActive" {{ $blog->status ? 'checked' : '' }}>
                                                <!-- line -->
                                                <div class="block bg-gray-600 w-14 h-4 rounded-full"></div>
                                                <!-- dot -->
                                                <div class="dot absolute left-1 top-1 bg-white w-6 h-2 rounded-full transition"></div>
                                            </div>
                                        </label>
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $blog->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{  url('/author/blog/'.$blog->slug)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-eye"></i></a>
                                    <a href="{{  url('author/edit/blog-post/'.$blog->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-edit"></i></a>
                                    <a href="{{  url('author/delete/blog-post/'.$blog->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <script>
        function changeStatus(id) {
            let status = $(".toggle-status").is(":checked") ? 1 : 0;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeAuthorBlogStatus',
                data: {'status': status, 'id': id},
                success: function (data) {

                    if(data == true){
                        toastr.info(data.notification, data.message);
                    }else {
                        toastr.success(data.notification, data.message);
                    }
                },
                error: function (data) {
                    toastr.error(data.notification, data.message);
                }


            })

        }

    </script>

@endsection

