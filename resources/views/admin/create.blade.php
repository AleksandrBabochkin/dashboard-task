@extends('adminlte::page')

@section('title', (isset($title)) ? $title : __('titles.index'))

@section('content_header')
    <h3>{{ (isset($title)) ? $title : __('titles.index') }}</h3>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                @yield('card-header')
                    @if ($errors->any())
                        <br>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @yield('form')
            </div>
        </div>
    </div>
@stop
