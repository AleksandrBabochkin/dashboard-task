@extends('admin.app')

@section('button')
    @pm
        <a href="{{route('task.create')}}" class="btn btn-primary btn-lg btn-block btn-flat">
            Создать
        </a>
    @endpm
@stop


@section('js')
    <script>
        let datatable =
            DatatableHelper.init('#datatable-list', '{!! route('task.list') !!}',
                {!! $jsonColumns !!}, function (d) {
                    d.status = $('select[id=status]').val();
                    d.user = $('select[id=user]').val();
                    d.type = $('select[id=type]').val();
                });
    </script>
@stop
