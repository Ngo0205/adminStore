@extends('layout.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/index/index.css')}}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Sản phẩm', 'key' => 'Edit'])
        <form action="{{route('products.update',['id'=>$products->id])}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên sản phẩm</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       id="exampleInput"
                                       placeholder="Tên sản phẩm"
                                       value="{{$products -> name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Giá sản phẩm</label>
                                <input type="text"
                                       name="price"
                                       class="form-control"
                                       id="exampleInput"
                                       placeholder="Giá sản phẩm"
                                       value="{{$products -> price}}">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"
                                       name="feature_image"
                                       class="form-control-file">
                            </div>
                            <div class="col-md-12 ">
                                <div class="row">
                                    <img class="image_product_edit" src="{{$products->feature_image}}" , alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file"
                                       multiple
                                       name="image[]"
                                       class="form-control-file">
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($products->productImageDetail as $value)
                                        <div class="col-md-3 ">
                                            <img class="image_product_detail" src="{{$value->image}}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init"
                                        name="category_id"
                                        id="exampleFormControlSelect1">
                                    <option value="">Chon danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhap tags cho sản phẩm</label>
                                <select name="tag[]" class="form-control tag_select_choose"
                                        multiple="multiple">
                                    @foreach($products->tags as $value)
                                    <option selected value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Nhập nội dung</label>
                            <textarea name="contents" class="form-control tinymce_editor_init"
                                      rows="3">{{$products->content}}</textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>
@endsection






