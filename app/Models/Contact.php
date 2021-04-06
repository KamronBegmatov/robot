<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contact
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Monitor[] $monitors
 * @property-read int|null $monitors_count
 */
class Contact extends Model
{
    protected $guarded=[];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function monitors()
    {
        return $this->belongsToMany(Monitor::class,'monitor_contact');
    }
}
