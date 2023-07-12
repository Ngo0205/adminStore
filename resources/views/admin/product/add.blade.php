@extends('layout.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>

@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Sản phẩm', 'key' => 'Add'])
        <div class="col-md-12">
        </div>
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên sản phẩm</label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="exampleInput"
                                       placeholder="Tên sản phẩm"
                                       value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Giá sản phẩm</label>
                                <input type="text"
                                       name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       id="exampleInput"
                                       placeholder="Giá sản phẩm"
                                       value="{{old('price')}}">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"
                                       name="feature_image"
                                       class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file"
                                       multiple
                                       name="image[]"
                                       class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id"
                                        id="exampleFormControlSelect1">
                                    <option value="">Chon danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhap tags cho sản phẩm</label>
                                <select name="tag[]" class="form-control tag_select_choose"
                                        multiple="multiple"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Nhập nội dung</label>
                            <textarea name="contents"
                                      class="form-control tinymce_editor_init @error('contents') is-invalid @enderror"
                                      rows="3">{{old('contents')}}</textarea>
                            @error('contents')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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





