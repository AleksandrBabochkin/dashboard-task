@extends('admin.create')

@section('card-header')
    <div class="card-header">
        <h3 class="card-title">{{(isset($title)) ? $title : __('titles.index') }}</h3>
    </div>
@endsection
@section('form')
    <form id="form_data" role="form" method="POST" action="@if($method == 'edit')
    {{ route('task.update', $model->id) }}
    @else
    {{ route('task.store') }}
    @endif">
        {{ csrf_field() }}
        @if($method == 'edit')
            {{ method_field('PATCH') }}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" name="name" class="form-control" id="name"
                               placeholder="Enter name" required
                               value="@if(!is_null(old('name'))){{ old('name') }}@elseif(isset($model)){{ $model->name }}@endif"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" name="description" class="form-control" id="description"
                               placeholder="Enter description" required
                               value="@if(!is_null(old('description'))){{ old('description') }}@elseif(isset($model)){{ $model->description }}@endif"
                        >
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" class="form-control" id="status" required>
                            @foreach($statuses as $key => $status)
                                <option value="{{$status}}"
                                        @if(isset($model) && $key == $model->status) selected @endif>
                                    {{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Тип</label>
                        <select name="type" class="form-control" id="tupe" required>
                            @foreach($types as $key => $type)
                                <option value="{{$type}}"
                                        @if(isset($model) && $key == $model->type) selected @endif>
                                    {{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!\App\Models\User::isDevelop())
                        <div class="form-group">
                            <label for="user">Пользователь</label>
                            <select name="user_id" class="form-control" id="user" required>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"
                                            @if(isset($model) && $user->id == $model->user_id) selected @endif>
                                        {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
