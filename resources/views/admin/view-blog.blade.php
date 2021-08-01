@extends('admin.master')
@section('title', 'Analytics')
@section('admin_content')

    <div class="shadow overflow-hidden my-4 mx-6">
        <div class="">
            @php($image = json_decode($viewPost->images))
            <img src="{{asset($image[0])}}" alt="blog post thumbnail" class="xl:mx-96 lg:mx-4">

            <h2 class="text-2xl font-semibold text-green-500 mx-6 my-8">{{ $viewPost->title }}   |    <span class="text-xl font-extralight">Author : {{ $viewPost->user->name }}</span></h2>
            <div class="mx-6">
                <p class="">{!!  html_entity_decode($viewPost->description) !!}</p>
            </div>


        <div class="mx-6 mb-10  bg-yellow-400">
            <p class="mt-5 text-green-500 ">{!!  html_entity_decode($viewPost->summary) !!}</p>
        </div>
        </div>


    </div>
@endsection
