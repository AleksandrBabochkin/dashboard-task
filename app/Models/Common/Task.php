<?php

namespace App\Models\Common;

use App\Models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Common\Task
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $status
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use Timestamp;

    protected $fillable = [
        'name', 'description', 'status', 'type', 'user_id'
    ];

    public const USUALLY = 10;
    public const URGENTLY = 20;

    static public array $types = [
        self::USUALLY  => 'usually',
        self::URGENTLY => 'urgently',
    ];

    public const APPOINTED = 10;
    public const IN_WORK = 20;
    public const DONE = 30;

    static public array $statuses = [
        self::APPOINTED => 'appointed',
        self::IN_WORK => 'in_work',
        self::DONE => 'done',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function getTypeAttributes($type): string
    {
        return self::$types[$type];
    }

    protected function getStatusAttributes($status): string
    {
        return self::$statuses[$status];
    }

    public function setStatusAttribute($status)
    {
        return $this->attributes['status'] = array_flip(self::$statuses)[$status];
    }

    public function setTypeAttribute($type)
    {
        return $this->attributes['type'] = array_flip(self::$types)[$type];
    }
}
