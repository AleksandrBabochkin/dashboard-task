<?php
declare(strict_types=1);

namespace App\Service\Admin;

use App\Models\Admin\Task;
use Yajra\DataTables\DataTables;

class TaskService
{
    public function getTableColumns(): array
    {
        return [
            [
                'data'          => 'id',
                'column_name'   => '#',
                'name'          => 'id',
            ],
            [
                'data'          => 'name',
                'column_name'   => 'Название',
                'name'          => 'name',
            ],
            [
                'data'          => 'description',
                'column_name'   => 'Описание',
                'name'          => 'description',
            ],
            [
                'data'          => 'status',
                'column_name'   => 'Статус',
                'name'          => 'status',
            ],
            [
                'data'          => 'type',
                'column_name'   => 'Тип',
                'name'          => 'type',
            ],
            [
                'data'          => 'action',
                'column_name'   => 'Действия',
                'sortable'      => false,
                'searchable'    => false,
                'width'         => '20%',
            ],
        ];
    }

    public function updateOrCreate($request, $model): Task
    {
        /** @var Task $model */
        $model->name = $request->input('name');
        $model->description = $request->input('description');
        $model->status = $request->input('status');
        $model->type = $request->input('type');
        $model->user_id = $request->input('user_id');
        $model->save();

        return $model;
    }

    public function getDatatableElements($request)
    {
        $data = Task::query()->orderByDesc('id')
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->user, function ($query) use ($request) {
                return $query->where('user_id', $request->user);
            })
            ->when($request->type, function ($query) use ($request) {
                return $query->where('type', $request->type);
            })
            ->get();

        return Datatables::of($data)
            ->addColumn('status', function ($data) {
                return Task::$statuses[$data->status];
            })
            ->addColumn('type', function ($data) {
                return Task::$types[$data->type];
            })
            ->addColumn('action', 'admin.task.datatable.action')
            ->rawColumns(['action',])
            ->make(true);
    }
}
