@extends('adminlte::page')

@section('title', (isset($title)) ? $title : __('titles.index'))

@section('content_header')
    <h3>{{ (isset($title)) ? $title : __('titles.index') }}</h3>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <a href="#filter" class="btn btn-default btn-lg btn-block btn-flat"
                       data-toggle="collapse">Фильтр</a>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group">
                        <input type="text" class="form-control search form-control-lg" data-type="search"
                               placeholder="Поиск">
                        <span class="input-group-btn input-group-btn-lg">
                                <a href="javascript:void(0);" class="btn btn-lg btn-primary btn-flat-lg"
                                   data-type="search">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                            </span>
                    </div>
                </div>
                <div class="col-md-3">
                    @yield('button')
                </div>
            </div>
            <div id="filter" class="collapse in">
            <div class="row">
                <div class="col-md-12">
                        <div>
                            <div class="form-group">
                                <label for="user">Пользователь</label>
                                <select class="form-control" id="user">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select class="form-control" id="status">
                                    <option></option>
                                    @foreach($statuses as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select class="form-control" id="type">
                                    <option></option>
                                    @foreach($types as $key => $type)
                                        <option value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <table class="table" id="datatable-list" style="width:100%">
                        <thead style="width:100%">
                        <tr>
                            @if(isset($columns))
                                @foreach($columns as $column)
                                    <th>
                                        {{ $column['column_name'] }}
                                    </th>
                                @endforeach
                            @endif
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
