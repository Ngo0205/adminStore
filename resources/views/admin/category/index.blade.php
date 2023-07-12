@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Category', 'key' => 'List'] )
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('categories.create')}}" class="btn_success float-right m-2">ADD</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <a href="{{route('categories.edit',['id'=>$value->id])}}" class="btn btn-Edit">Edit</a>
                                        <a href="{{route('categories.delete',['id'=>$value->id])}}"
                                           class="btn btn-Delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




