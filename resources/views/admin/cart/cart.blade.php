@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/product/index/index.js')}}"></script>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Cart', 'key' => 'List'] )
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người mua</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Note</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->number_phone}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>{{$value->note}}</td>
                                    <td>{{number_format($value->total)}}</td>
                                    <td>
                                        <a href="{{route('cart.cart_detail',['id'=> $value->id])}}"
                                           class="btn btn-Edit">Chi tiết</a>
                                        <a href=""
                                           data-url="{{route('cart.delete',['id'=>$value->id])}}"
                                           class="btn btn-danger action_delete">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $carts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
