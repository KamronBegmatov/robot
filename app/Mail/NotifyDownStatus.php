<?php

namespace App\Mail;

use App\Models\DownTime;
use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyDownStatus extends Mailable
{
    use Queueable, SerializesModels;

    protected $monitor;
    protected $down_time;

    public function __construct(Monitor $monitor, DownTime $down_time)
    {
        $this->monitor = $monitor;
        $this->down_time = $down_time;
    }

    public function build()
    {
        return $this->from('dostupno.uz@gmail.com')
                    ->view('emails.notify_down_status')
                    ->with([
                    'name' => $this->monitor->name,
                    'url' => $this->monitor->url,
                    'timestamp' => $this->down_time->created_at,
                    ]);
    }
}
