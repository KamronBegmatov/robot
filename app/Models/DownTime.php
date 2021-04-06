<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DownTime
 *
 * @property int $monitor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime whereDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownTime whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $down
 */
class DownTime extends Model
{

    protected $guarded=[];
}
