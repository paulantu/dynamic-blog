@extends('admin.master')
@section('title', 'Manage Role')
@section('admin_content')

<div class="flex flex-wrap mt-8 pr-8 object-right">
    <div class=""w-full>
    <button class="ml-4 bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('roleModel')">
        add role
    </button>
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="roleModel">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Add Role
                    </h3>
                    <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('roleModel')">
      <span class="bg-transparent text-red-500 text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
        <i class="fas fa-times"></i>
      </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">

                    <form class="" action="{{ url('admin/role/store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-500 font-medium text-sm mb-2">Role</label>
                            <input type="text" placeholder="Enter Your role" id="name" name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                        </div>
                        <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                                Close
                            </button>
                            <button class="bg-emerald-500 text-gray-500 active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>

    </div>


</div>


<div class="flex flex-wrap min-w-full">

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4 ml-4">
    <div class="-my-2 sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Base User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($roles as $role)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $roles->firstItem()+$loop->index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $role->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">null</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $role->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{  url('admin/edit/role/'.$role->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-edit"></i></a>
                                    <a href="{{  url('admin/delete/role/'.$role->id)  }}" class="text-indigo-600 hover:text-indigo-900"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
</div>



@endsection
