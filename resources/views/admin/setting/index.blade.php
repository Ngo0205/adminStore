@extends('layout.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.header-content', ['name' => 'Setting', 'key' => 'List'] )


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle float-lg-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add setting
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('setting.create', '?type=Text')}}">Text</a>
                                <a class="dropdown-item" href="{{route('setting.create', '?type=Textarea')}}">Textarea</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Setting</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settingIndex as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->config_key}}</td>
                                    <td>{{$value->config_value}}</td>
                                    <td>
                                        <a href="{{route('setting.edit',['id'=> $value->id]). '?type= '.$value->type}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('setting.delete',['id' => $value->id])}}"
                                           class="btn btn-danger action_delete_setting">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $settingIndex->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/setting/indexDelete.js')}}"></script>
@endsection




