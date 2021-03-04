@extends('layouts.blog')

@section('title')
@endsection

@section('header')
<header class="header text-white" style="background-color: #b9a0c9;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <!-- Header -->

                <div class="container">
                    <h1 class="display-4">Cart Overview</h1>
                    <p class="lead-2 mt-6">Take a look inside your cart. Make sure you have everything you needed.</p>
                </div>
                <!-- /.header -->

            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<main class="main-content">


    <section class="section">
        <div class="container">

            <div class="row gap-y">
                <div class="col-lg-8">

                    <table class="table table-cart">
                        <tbody valign="middle">
                            @if($carts->count() > 0)
                            @foreach($carts as $cart)
                            <tr>
                                <td>
                                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <!-- <a class="item-remove" ><i class="ti-close"></i></a> -->
                                        <button class="item-remove" type="submit" style="border: none; background-color: white;"><i class="ti-close"></i></button>

                                    </form>
                                </td>

                                <td>
                                    <a href="item.html">
                                        <img class="rounded" src="{{ asset('storage/'.$cart->image) }}" alt="...">
                                    </a>
                                </td>

                                <td>
                                    <h5>{{ $cart->title }}</h5>
                                    <p>{{ $cart->option }}</p>
                                </td>

                                <td>
                                    <label>Quantity</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="Quantity" value="{{ $cart->qty }}">
                                </td>

                                <td>
                                    <h4 class="price">{{ $cart->price }}$</h4>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <div>
                                <h3 class="ml-5" style="opacity: 50%;">No Cart Found</h3>
                            </div>
                            @endif

                        </tbody>
                    </table>

                </div>


                <div class="col-lg-4">
                    <div class="cart-price">
                        <div class="flexbox">
                            <div>
                                <p><strong>Subtotal:</strong></p>
                                <p><strong>Shipping:</strong></p>
                                <p><strong>Tax (%10):</strong></p>
                            </div>

                            <div class="text-center">
                                <p>{{ $subTotal }}$</p>
                                @if($carts->count() > 0)
                                <p>2$</p>
                                @endif
                                <p>{{ $vat }}$</p>
                            </div>
                        </div>

                        <hr>

                        <div class="flexbox">
                            <div>
                                <p><strong>Total:</strong></p>
                            </div>

                            <div>
                                <p class="fw-600" style="font-size: 20px;">{{ $total }}$</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-block btn-secondary" href="{{ route('welcome') }}">Shop more</a>
                        </div>

                        <div class="col-6">
                            <button class="btn btn-block btn-primary" type="submit">Proceed <i class="ti-angle-right fs-9"></i></button>
                        </div>
                    </div>

                </div>
            </div>



        </div>



</main>
@endsection