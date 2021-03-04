@extends('layouts.blog')

@section('title')
Post1
@endsection

@section('header')
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
    <div class="container">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h1>SHOPPING</h1>


            </div>
        </div>

    </div>
</header>
@endsection

@section('content')
<main class="main-content">

    <!-- <section class="section" style="margin-top: -100px; margin-bottom: -100px;">
        <div data-provide="slider" data-autoplay="true" data-slides-to-show="2" data-css-ease="linear" data-speed="12000" data-autoplay-speed="0" data-pause-on-hover="false">
            @foreach($posts as $post)
            <div class="p-2">
                <div class="rounded bg-img h-400" style="background-image: url({{ asset('storage/'.$post->image) }})"></div>
            </div>
            @endforeach
        </div>
    </section> -->

    <div class="section bg-gray">
        <div class="container">
            <div class="row">



                <div class="col-md-8 col-xl-9">
                    <div class="row gap-y">

                        @forelse($posts as $post)
                        <div class="col-md-4">
                            <div class="card border hover-shadow-6 mb-6 d-block product-3">
                                <div class="product-media">
                                    <div class="slider-dots-inside" data-provide="slider" data-dots="true">
                                        <a href="{{ route('blog.show', $post->id) }}">
                                            <img src="{{ asset('storage/'.$post->image) }}" alt="product">
                                        </a>
                                        <a href="item.html">
                                            <img src="{{ asset('storage/'.$post->album->image) }}" alt="product" >
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h6><a href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a></h6>
                                    <div class="product-price">{{ $post->price }}$</div>
                                </div>
                            </div>
                        </div> 
                        @empty
                        <a href="" class="text-center">
                            No results found for query &nbsp&nbsp <i class="ti-search"></i> "<strong>{{ request()->query('search') }}</strong>"
                        </a>
                        @endforelse

                    </div>


                    {{ $posts->appends(['search', request()->query('search') ])->links() }}
                </div>


                @include('partial.sidebar')


            </div>
        </div>
    </div>
</main>
@endsection