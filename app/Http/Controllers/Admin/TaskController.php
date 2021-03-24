<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\{Http\Controllers\Controller, Http\Requests\Admin\Task\TaskRequest};
use App\Models\{Admin\Task, User};
use App\Service\Admin\TaskService;
use Illuminate\{Http\RedirectResponse, Http\Request};

class TaskController extends Controller
{
    private const TEMPLATE_PATH = 'admin.task.';
    public TaskService $service;

    public function __construct(TaskService $taskService)
    {
        $this->service = $taskService;
    }

    public function index()
    {
        $columns = $this->service->getTableColumns();
        $with = [
            'columns' => $columns,
            'jsonColumns' => json_encode($columns),
            'title' => 'Задания',
            'users' => User::all(),
            'types' => Task::$types,
            'statuses' => Task::$statuses,
        ];

        return view(self::TEMPLATE_PATH . __FUNCTION__)->with($with);
    }

    public function create()
    {
        $with = [
            'title' => 'Создать задание',
            'method' => __FUNCTION__,
            'statuses' => Task::$statuses,
            'types' => Task::$types,
            'users' => User::all()
        ];

        return view(self::TEMPLATE_PATH . __FUNCTION__)->with($with);
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = $this->service->updateOrCreate($request, new Task());

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        $with = [
            'title' => 'Создать задание',
            'method' => __FUNCTION__,
            'statuses' => Task::$statuses,
            'types' => Task::$types,
            'model' => $task,
            'users' => User::all()
        ];

        return view(self::TEMPLATE_PATH . 'create')->with($with);
    }


    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task = $this->service->updateOrCreate($request, $task);

        return redirect()->route('task.index');
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(['action' => 'reload_table']);
        }

        return redirect()->route('task.index');
    }

    public function listElement(Request $request)
    {
        if (request()->ajax()) {
            return $this->service->getDatatableElements($request);
        }

        return abort(404);
    }
}
