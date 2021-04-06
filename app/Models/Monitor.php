<?php

namespace App\Models;

use App\Mail\NotifyStatus;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * App\Models\Monitor
 *
 * @property int $id
 * @property int $user_id
 * @property string $monitor_type
 * @property string $name
 * @property string $url
 * @property string $interval
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereMonitorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitor whereUserId($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 */
class Monitor extends Model
{

    protected $guarded = [];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class,'monitor_contact');
    }

    public static function url_test($url)
    {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (($http_code == "200") || ($http_code == "302")) {
            return true;
        } else {
            return $http_code;
        }
        curl_close($ch);
    }

    public static function checkStatus()
    {
        $success = array();
        foreach (Monitor::all() as $monitor) {
            $url = $monitor->url;
            if (Monitor::url_test($url)) {
                array_push($success, $url);
            } else {
                $down_time = DownTime::create([
                    'monitor_id' => $monitor->id,
                    'down' => 1,
                ]);
                $contact_id = DB::table('monitor_contact')->where('monitor_id', $monitor->id)->first()->contact_id;
                $email = Contact::findOrFail($contact_id)->email;
                $monitor = Monitor::findOrFail($monitor->id);
                Mail::to($email)->send(new NotifyStatus($monitor, $down_time));
            }
        }
    }
}
