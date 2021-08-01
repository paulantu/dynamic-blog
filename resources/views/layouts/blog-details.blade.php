@extends('layouts.master')

@section('content')



    <section class="container mx-auto py-6 mt-32 mb-12">

        @foreach($postDetails as $post)
            <h2 class="flex text-5xl px-16">
                {{ $post->title }}
            </h2>
        <span class="px-16">author : {{ $post->user->name }}</span>
        @php( $images = json_decode($post->images))
        <div class="justify-center flex mt-8">
            <img src="{{ asset($images[0]) }}">
        </div>

        <ul class="justify-center flex space-x-4 mt-8">
                @foreach($images as $image)
                <li class=""><img src="{{ asset($image) }}" class="blog images" height="200px" width="200px"></li>
            @endforeach
        </ul>

            <div class="p-16">
                <p class>
                    {!! html_entity_decode( $post->description ) !!}
                </p>
            </div>
            <div class="p-16 bg-yellow-700 text-2xl text-green-400">
                <p class="">
                    {!! html_entity_decode( $post->summary ) !!}
                </p>
            </div>





            <div class="commentBox px-16 ">
                <h2 class="text-5xl mt-16 mb-16">
                    Comments
                </h2>
                @foreach($comments as $comment)
                    <div class="flex mb-3">
                        <div class="rounded-full h-16 w-16 flex items-center justify-center bg-yellow-500">{{ $comment->first_name }}</div>
                        <div class="px-16 py-4">{{ $comment->message }}</div>
                    </div>
                @endforeach
            </div>








            <div class="commentBox px-16">
                <h2 class="text-5xl mt-16 mb-16">
                    Leave a comment
                </h2>
                <form class="w-full max-w-lg" action="{{ url('/comment/'.$post->id) }}" id="" method="post">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first_name">
                                First Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="first_name" name="first_name" type="text" required placeholder="Jane">
                            <p class="text-white-500 text-xs italic">Please fill out this field.</p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last_name">
                                Last Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last_name" name="last_name" type="text" placeholder="Doe">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                Email
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="text" placeholder="johndoe@domain.com">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full  px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="message">
                                Messsage
                            </label>
                            <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="message" name="message" required></textarea>
                            <p class="text-white-500 text-xs italic">Please fill out this field.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full  px-3">
                            <button type="submit" class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                               Submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        @endforeach
    </section>



@endsection
