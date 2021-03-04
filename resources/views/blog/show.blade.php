@extends('layouts.blog')

@section('title')
{{ $posts->title }}
@endsection

@section('header')
<header class="header text-white" style="background-color: #b9a0c9;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h1 class="display-4">{{ $posts->title }}</h1>
                <p class="lead-2 opacity-90 mt-6">{{ $posts->description }}</p>

            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<main class="main-content">


    <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Blog content
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
    <form action="{{ route('carts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="container">

                <div class="row">

                    <div class="col-md-6 ml-auto order-md-last mb-7 mb-md-0 mt-7">
                        <div id="slider-image" data-provide="slider" data-as-nav-for="#slider-thumb">
                            @foreach($posts->album->photos as $post)
                            <div class="p-2"><img src="{{ asset('storage/'.$post->image) }}" style="height: 300px; width:100%"></div>
                            @endforeach

                        </div>
                        <div id="slider-thumb" data-provide="slider" data-as-nav-for="#slider-image" data-slides-to-show="3" data-center-mode="true" data-dots="true" data-focus-on-select="true">
                            @foreach($posts->album->photos as $post)
                            <div class="p-2"><img class="cursor-pointer" src="{{ asset('storage/'.$post->image) }}" style="height: 100px; width:100%"></div>
                            @endforeach
                        </div>

                    </div>

                    <div>
                        <input type="hidden" name="image" value="{{ $posts->image }}">
                        <input type="hidden" name="title" value="{{ $posts->title }}">
                        <input type="hidden" name="price" value="{{ $posts->price }}">
                    </div>

                    <div class="col-11 mx-auto col-md-5 mx-md-0">
                        <p class="text-light my-6">{{ $posts->description }}</p>

                        <ul class="list-unstyled">
                            <li><span class="mr-1 ti-check text-success small-3"></span> Built in GPS</li>
                            <li><span class="mr-1 ti-check text-success small-3"></span> Heart Rate Sensor</li>
                            <li><span class="mr-1 ti-check text-success small-3"></span> Water Resistant 50 Meters</li>
                            <li><span class="mr-1 ti-check text-success small-3"></span> Comprehensive Workout App</li>
                        </ul>

                        <div class="row gap-y align-items-center text-center bg-light rounded p-5 mt-7">
                            <div class="col-md-auto ml-auto order-md-last">
                                <h4 class="lead-5 mb-0 lh-1 fw-500">{{ $posts->price }}$</h4>
                                <small class="text-lighter">+ $10 shipping fees</small>
                            </div>

                            <div class="col-md-auto">

                                <a class="btn btn-lg btn-primary" href="#">Purchase</a><br><br>


                                @include('sweetalert::alert')

                                <a class="btn btn-lg btn-warning" data-toggle="modal" data-target="#exampleModal" href="#">Add to cart</a>

                                @auth
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="{{ asset('storage/'.$posts->image) }}" alt="">
                                                <h5 class="modal-title"></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div style="margin-top: -20px;">
                                                    <label for=""> <strong>Price :</strong> </label>
                                                    <button type="button" class="btn btn-round btn-info">{{ $posts->price }}$</button>
                                                </div><br>

                                                <label for=""> <strong>Quanity :</strong> </label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Quantity" name="qty" value="1">

                                                <label for=""> <strong>Color :</strong> </label>
                                                <select name="option" id="option" class="form-control">
                                                    @foreach($posts->options as $post)
                                                    <option value="{{ $post->name }}">
                                                        <button type="button" class="btn btn-secondary">{{ $post->name }}</button>
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body p-md-0">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-xl-6 d-none d-md-flex bg-img rounded-left" style="background-image: url({{ asset('img/3.jpg') }})"></div>

                                                    <div class="col-md-8 col-xl-5 mx-auto">
                                                        <form class="py-7">
                                                            <h4 class="fw-200 text-center mt-5">Login</h4>
                                                            <p class="text-center">Sign into your account using your credentials.</p>
                                                            <hr class="w-25">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="username" placeholder="Username">
                                                            </div>

                                                            <div class="form-group">
                                                                <input class="form-control" type="password" name="password" placeholder="Password">
                                                            </div>

                                                            <div class="row align-items-center pt-3 pb-5">
                                                                <div class="col-auto">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox">
                                                                        <label class="custom-control-label">Remember me</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col text-right">
                                                                    <p class="mb-0 fw-300"><a class="text-muted small-2" href="#">Forgot password?</a></p>
                                                                </div>
                                                            </div>

                                                            <button class="btn btn-lg btn-block btn-primary" type="submit">Login</button>

                                                            <div class="divider">Or sign in with</div>
                                                            <div class="text-center">
                                                                <a class="btn btn-square btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
                                                                <a class="btn btn-square btn-google" href="#"><i class="fa fa-google"></i></a>
                                                                <a class="btn btn-square btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                                                            </div>

                                                            <p class="small-2 text-center mt-5 mb-5">Don't have an account? <a href="#">Create one</a></p>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endauth

                            </div>
                        </div>
                    </div>

                </div>

                <hr class="my-8">

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h5>Full specification</h5>

                        <p>Interactively foster interoperable schemas rather than client-centric architectures. Progressively drive collaborative human capital vis-a-vis optimal ideas. Monotonectally fashion cross-platform leadership skills through high standards in manufactured products. Continually reintermediate.</p>
                        <p>Progressively deliver ethical schemas before equity invested intellectual capital. Rapidiously embrace value-added manufactured products rather than 24/7 information. Credibly whiteboard compelling methodologies installed base action items. Objectively maintain.</p>

                        <h6>Warranty</h6>
                        <p>Synergistically empower multimedia based scenarios before backward-compatible testing procedures. Interactively disintermediate distinctive portals with state of the art sources. Conveniently architect process-centric quality vectors for cross-platform models. Continually expedite.</p>

                        <h6>Shipping info</h6>
                        <p>Progressively morph plug-and-play value without market positioning partnerships. Authoritatively myocardinate high standards in deliverables and effective opportunities. Interactively whiteboard premium relationships rather than go forward expertise. Phosfluorescently target process-centric.</p>

                    </div>
                </div>

            </div>
        </section>
    </form>

    <section class="section bg-gray bt-1">
        <div class="container">

            <h4 class="mb-7">Similar products</h4>

            <div class="row gap-y">



                @foreach($postalot as $post)
                @if($post->catagory->id == $posts->catagory->id)
                <div class="col-md-6 col-xl-3">
                    <div class="product-3">
                        <a class="product-media" href="{{ route('blog.show', $post->id) }}">
                            <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                            <img src="{{ asset('storage/'.$post->image) }}" alt="product" style="height: 170px; width: 100%;">
                        </a>

                        <div class="product-detail">
                            <h6><a href="#">{{ $post->title }}</a></h6>
                            <div class="product-price">$299</div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach




                <!-- <div class="col-md-6 col-xl-3">
                    <div class="product-3">
                        <a class="product-media" href="item.html">
                            <span class="badge badge-pill badge-success badge-pos-right">-25%</span>
                            <img src="../assets/img/shop/12.jpg" alt="product">
                        </a>

                        <div class="product-detail">
                            <h6><a href="#">Sony PlayStation 4</a></h6>
                            <div class="product-price"><s>$299</s> $224</div>
                        </div>
                    </div>
                </div> -->




            </div>

        </div>
    </section>

    <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Comments
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
    <div class="section bg-gray">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mx-auto">


                    <hr>


                    <div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

                        var disqus_config = function() {
                            this.page.url = "{{ config('app.url') }}/blog/posts/{{ $post->id }}"; // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://sass-blog-fyg8ubvckv.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                </div>
            </div>

        </div>
    </div>

</main>
@endsection

@section('script')
<script>

</script>
@endsection