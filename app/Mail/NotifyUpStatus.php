<?php

namespace App\Mail;

use App\Models\Monitor;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUpStatus extends Mailable
{
    use Queueable, SerializesModels;

    protected $monitor;

    public function __construct(Monitor $monitor)
    {
        $this->monitor = $monitor;
    }

    public function build()
    {
        return $this->from('dostupno.uz@gmail.com')
            ->view('emails.notify_up_status')
            ->with([
                'name' => $this->monitor->name,
                'url' => $this->monitor->url,
                'timestamp' => Carbon::now(),
            ]);
    }
}
