<?php
declare(strict_types=1);

namespace App\Models\Admin;

use App\Models\Admin\Filter\TaskFilter;
use App\Models\Common\Task as T;
use Illuminate\Database\Eloquent\Builder;

class Task extends T
{
    public function scopeFilter(Builder $query, TaskFilter $filter): void
    {
        $filter->apply($query);
    }
}
