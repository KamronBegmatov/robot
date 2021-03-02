<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Policies\MonitorPolicy;
use Eloquent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Monitor[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $monitors = Monitor::where('user_id', auth()->user()->id)->get();
        if ($request->has('monitor_id')) {
            return $monitors->firstWhere('id', $request->monitor_id);
        }
        $monitors = $monitors->sortBy('monitors.id')->groupBy('monitors.id');
        return $monitors;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
    public function store(Request $request)
    {
        $user = auth()->user();
        Monitor::create([
            'user_id' => $user->id,
            'monitor_type' => $request->monitor_type,
            'name' => $request->name,
            'url' => $request->url,
            'interval' => $request->interval,
        ]);
        return response()->json('Monitor added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return Response
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return Response
     */
    public function edit(Monitor $monitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Monitor $monitor
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Monitor $monitor)
    {
            $monitor->update([
                      'monitor_type' => $request->monitor_type,
                      'name' => $request->name,
                      'url' => $request->url,
                      'interval' => $request->interval,
                   ]);
            return response()->json('Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Monitor $monitor
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Monitor $monitor)
    {
        if($monitor->delete()){
            return response()->json('Monitor successfully deleted!');
        }
        return response()->json('Something went wrong:(');
    }
}
