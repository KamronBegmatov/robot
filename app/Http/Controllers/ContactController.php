<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', auth()->user()->id);
        $pages = 10;
        if ($request->has('per_page')) {
            $pages = $request->per_page;
        }
        return ContactResource::collection($contacts->paginate($pages));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'ups_downs' => 'required',
        ]);
        $contact = Contact::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'ups_downs' => $request->ups_downs,
        ]);
        return new ContactResource($contact);
    }

    public function show(Request $request, Contact $contact)
    {
        $request->validate([
            'contact_id' => 'exists:contacts,id',
        ]);
            return new ContactResource(Contact::findOrFail($request->contact_id));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'contact_id' => 'exists:contacts,id',
        ]);
        if ($request->has('type')) {
            $contact->type = $request->type;
        }
        if ($request->has('name')) {
            $contact->name = $request->name;
        }
        if ($request->has('email')) {
            $contact->email = $request->email;
        }
        if ($request->has('ups_downs')) {
            $contact->ups_downs = $request->ups_downs;
        }
        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
                return response()->json('Contact successfully deleted!');
        } catch (\Exception $e) {
            return response()->json('Something went wrong:(');
        }
    }
}
