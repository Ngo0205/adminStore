@extends('layout.admin')

@section('title')
    <title>Sản Phẩm</title>
@endsection

@section('css')
    <link href="{{asset('admins/product/index/index.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/product/index/index.js')}}"></script>
@endsection


@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Sản phẩm', 'key' => 'List'] )
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn_success float-right m-2">ADD</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Image</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->price}}</td>
                                    <td>
                                        <img class="image_product" src="{{$value->feature_image}}" alt=''>
                                    </td>
                                    <td>{{optional($value->category)->name}}</td>
                                    <td>
                                        <a href="{{route('products.edit',['id'=>$value->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('products.delete',['id'=>$value->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $product->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





