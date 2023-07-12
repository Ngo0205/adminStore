@extends('layout.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('css')
    <link href="{{asset('admins/setting/add.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.header-content', ['name' => 'Setting', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('setting.update', ['id' => $dataSettingEdit -> id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Config Key</label>
                                <input type="text"
                                       name="config_key"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       id="exampleInput"
                                       placeholder="Config Key"
                                       value="{{$dataSettingEdit->config_key}}">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label for="exampleInput">Config Value</label>
                                    <input type="text"
                                           name="config_value"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           id="exampleInput"
                                           placeholder="Config value"
                                           value="{{$dataSettingEdit->config_value}}">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label for="exampleInput">Config Value</label>
                                    <textarea
                                        name="config_value"
                                        class="form-control @error('config_value') is-invalid @enderror"
                                        id="exampleInput"
                                        placeholder="Config value"
                                        rows="3">
                                        {{$dataSettingEdit->config_value}}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif


                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






