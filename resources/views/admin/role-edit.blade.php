@extends('admin.master')
@section('title', 'Manage Role')
@section('admin_content')

    <div class="flex flex-wrap mt-8 pr-8">
        <div class="p-10">
            <div class="min-w-lg rounded overflow-hidden shadow-lg">
                <h2 class="p-6 text-2xl">Edit role</h2>
                    <form class="" action="{{ url('admin/role/update/'.$role_datas->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-500 font-medium text-sm mb-2">Role</label>
                            <input type="text" value="{{ $role_datas->name }}" id="name" name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                        </div>
                        <button class="bg-emerald-500 text-gray-500 active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">
                            Save
                        </button>
                    </form>
            </div>
        </div>
    </div>



@endsection
