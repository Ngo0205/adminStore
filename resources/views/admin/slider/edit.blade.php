@extends('layout.admin')

@section('title')
    <title>Slider</title>
@endsection

@section('css')
    <link href="{{asset('admins/slider/add.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.header-content', ['name' => 'Slider', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.update',['id' => $sliderEdit ->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên Slider</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       id="exampleInput"
                                       placeholder="Ten slider"
                                       value="{{$sliderEdit->name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Mô tả</label>
                                <textarea class="form-control"
                                          name="description"
                                          rows="4">
                                    {{$sliderEdit->description}}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Hình ảnh</label>
                                <input type="file"
                                       name="image_path"
                                       class="form-control"
                                       id="exampleInput">
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <img class="image_slider_edit" src="{{$sliderEdit->image_path}}" , alt="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






