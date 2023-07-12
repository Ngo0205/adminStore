@extends('layout.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('css')
    <link href="{{asset('admins/slider/add.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.header-content', ['name' => 'Setting', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên Slider</label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="exampleInput"
                                       placeholder="Ten slider"
                                       value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Mô tả</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description"
                                    rows="3">
                                    {{old('description')}}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Hình ảnh</label>
                                <input type="file"
                                       name="image_path"
                                       class="form-control @error('image_path') is-invalid @enderror"
                                       id="exampleInput">
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection





