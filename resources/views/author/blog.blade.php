@extends('author.master')

@section('content')
    <section class="container mx-auto py-6 mt-16 mb-12">
        <div class="p-10">
            <!--Card 1-->
            @foreach($blogPosts as $post)
                <a href="{{ url('author/blog/'.$post->slug) }}" class="" >
                    <div class=" w-full lg:max-w-full lg:flex bg-gradient-to-r  my-6 hover:from-yellow-300 hover:to-red-500">
                        <div class="h-48 mt-8 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" title="Mountain">
                            @php
                                $image = json_decode($post->images)
                            @endphp
                            <img src="{{ asset($image[0]) }}" alt="blog thumbnail">
                        </div>
                        <div class="p-4 flex flex-col justify-between leading-normal">

                            <div class="mb-8">
                                <div class="text-gray-900 font-bold text-xl mb-2">{{ $post->title }}</div>
                                <p class="text-gray-700 text-base">
                                    {!! Str::limit(html_entity_decode( $post->description ), 200) !!}
                                </p>
                            </div>
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none">{{ $post->user->name }}</p>
                                    <p class="text-gray-600">{{ $post->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <hr />
            @endforeach




        </div>
    </section>



@endsection
