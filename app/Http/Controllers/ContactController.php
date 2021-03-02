<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function index(Request $request)
    {
        $contacts = Contact::create('user_id', auth()->user()->id)->get();
        if ($request->has('contact_id')) {
            return $contacts->firstWhere('id', $request->contact_id);
        }
        $contacts = $contacts->sortBy('products.id')->groupBy('products.id');
        return $contacts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        Contact::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'ups_downs' => $request->ups_downs,
        ]);
        return response()->json('Contact added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->update([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'ups_downs' => $request->ups_downs,
        ]);
        return response()->json('Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Contact $contact)
    {
        if($contact->delete()){
            return response()->json('Contact successfully deleted!');
        }
        return response()->json('Something went wrong:(');
    }
}
