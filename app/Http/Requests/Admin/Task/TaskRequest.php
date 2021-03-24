<?php
declare(strict_types=1);

namespace App\Http\Requests\Admin\Task;

use App\Models\Admin\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(Task::$statuses)],
            'type' => ['required', Rule::in(Task::$types)],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
