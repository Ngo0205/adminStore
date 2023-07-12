@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.header-content', ['name' => 'Category', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('categories.update',['id'=>$category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên danh mục</label>
                                <input type="text"
                                       name ="name"
                                       class="form-control"
                                       value="{{$category->name}}"
                                       id="exampleInput"
                                       placeholder="Ten danh muc">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn danh mục chủ</label>
                                <select class="form-control"
                                        name="parent_id"
                                        id="exampleFormControlSelect1">
                                    <option value="0">Chon danh mục chủ</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





