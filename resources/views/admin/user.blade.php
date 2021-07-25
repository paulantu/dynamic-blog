@extends('admin.master')
@section('title', 'Manage User')
@section('admin_content')
    <style>
        input:checked ~ .dot {
            transform: translateX(100%);
            background-color: #48bb78;
        }
    </style>
    <div class="flex flex-wrap min-w-full">
        <form class="w-full max-w-full mt-4 ml-4">
            <div class="flex items-center py-2">
                <input class="appearance-none border-b border-teal-500 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search by name" aria-label="Full name">
                <input class="appearance-none border-b border-teal-500 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search by role" aria-label="Full name">
                <input class="appearance-none border-b border-teal-500 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="date" placeholder="Search by Date" aria-label="Full name">
                <button class="flex-shrink-0 bg-yellow-500 hover:bg-yellow-700 border-red-500 hover:border-red-700 text-sm border-2 text-white py-1 px-2 rounded" type="button">
                    Search
                </button>
            </div>
        </form>

    </div>

    <div class="flex flex-wrap mt-4 ml-4">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $users->firstItem()+$loop->index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="post" action="{{url('change-user-role/'.$user->id)}}"  id="{{ $user->id }}">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="userId" class="userId">
                                        <select class="role" name="role_id">
                                            <option value="">{{ $user->Role->name }}</option>
                                            @foreach($roles as $role)
                                                <option data-url="{{ url('change-user-role/'.$user->id) }}" data-pk="{{ $user->id }}" data-type="select" value="{{$role->id}} ">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="">
                                    <div class="flex items-center justify-center w-full mt-1">

                                        <label for="toggle{{ $user->id }}" class="flex items-center cursor-pointer">
                                            <!-- toggle -->
                                            <div class="relative">
                                                <!-- input -->
                                                <input type="checkbox" data-id="{{$user->id}}" title="{{ $user->id }}" onchange="changeStatus(this.title)" id="toggle{{ $user->id }}" class="sr-only" class="toggle-status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                                                <!-- line -->
                                                <div class="block bg-gray-600 w-14 h-4 rounded-full"></div>
                                                <!-- dot -->
                                                <div class="dot absolute left-1 top-1 bg-white w-6 h-2 rounded-full transition"></div>
                                            </div>
                                        </label>
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{  url('admin/user/activities/'.$user->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-eye"></i></a>
                                    <a href="{{  url('admin/delete/user/'.$user->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


{{--    onchange role setup--}}
<script type="text/javascript">
    $(".role").change(function() {
        let id = $(this).parents("form").attr("id");
        $.ajax({
            type: "post",
            url: "change-user-role/" + id,
            data: {_token: "{{ csrf_token() }}",role_id: this.value },
            dataType: 'JSON',
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
        });
    });




    function changeStatus(id) {
            let status = $(".toggle-status").is(":checked") ? 1:0;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'id': id},
                success: function(data){
                    if(data == true){
                        toastr.info(data.notification, data.message);
                    }else {
                        toastr.success(data.notification, data.message);
                    }
                },
                error: function (data) {
                    toastr.error(data.notification, data.message);
                }
            });
        }
</script>

@endsection
