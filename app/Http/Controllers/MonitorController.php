<?php

namespace App\Http\Controllers;

use App\Http\Resources\MonitorResource;
use App\Models\Contact;
use App\Models\Monitor;
use App\Policies\MonitorPolicy;
use Eloquent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class MonitorController extends Controller
{
    const ARR =['contacts'];

    public function index(Request $request)
    {
        $monitors = Monitor::where('user_id', auth()->user()->id)->with(self::ARR);
        if ($request->has('monitor_id')) {
            $monitor = $monitors->findOrFail($request->monitor_id);
            return new MonitorResource($monitor);
        }
        $monitors = $monitors->groupBy('monitors.id');
        return MonitorResource::collection($monitors);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $monitor = Monitor::create([
            'user_id' => $user->id,
            'monitor_type' => $request->monitor_type,
            'name' => $request->name,
            'url' => $request->url,
            'interval' => $request->interval,
        ]);
        if($request->has('contact_id')){
            $contact = Contact::findOrFail($request->contact_id);
            $monitor->contacts()->sync($contact->id);
        }
        return new MonitorResource($monitor);
    }

    public function show(Monitor $monitor)
    {
        return new MonitorResource($monitor);
    }

    public function update(Request $request, Monitor $monitor)
    {
        $request->validate([
            'monitor_id' => 'exists:monitors,id',
        ]);
        if ($request->has('monitor_type')) {
            $monitor->monitor_type = $request->monitor_type;
        }
        if ($request->has('name')) {
            $monitor->name = $request->name;
        }
        if ($request->has('url')) {
            $monitor->url = $request->url;
        }
        if ($request->has('interval')) {
            $monitor->interval = $request->interval;
        }
        if($request->has('contact_ids')){
            $monitor->contacts()->sync($request->contact_ids);
        }
        return new MonitorResource($monitor);
    }

    public function destroy(Monitor $monitor)
    {
        try {
            $monitor->contacts()->detach();
            $monitor->delete();
        } catch (\Exception $e) {
            return response()->json('Something went wrong:(');
        }
        return response()->json('Monitor successfully deleted!');
    }

}
