@extends('layout.admin')

@section('title')
    <title>Menu</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.header-content', ['name' => 'Menu', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('menus.update',['id'=>$menuEdit->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Tên Menu</label>
                                <input type="text"
                                       name ="name"
                                       class="form-control"
                                       id="exampleInput"
                                       value="{{$menuEdit->name}}"
                                       placeholder="Ten Menu">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn Menu chính</label>
                                <select class="form-control"
                                        name="parent_id"
                                        id="exampleFormControlSelect1">
                                    <option value="0"> Chọn Menu chính </option>
                                    {!! $htmlSelect !!}
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





