<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Country;
use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $filters = $request->all('search');
        $contacts = Contact::with(['organization'])
                            ->when($filters['search'] ?? false, function($query, $search){
                                $query->where('first_name','LIKE','%'.$search.'%')
                                        ->orWhere('last_name','LIKE','%'.$search.'%')
                                        ->orWhere('city','LIKE','%'.$search.'%')
                                        ->orWhereHas('organization',function($query2) use ($search){
                                            $query2->Where('name','LIKE','%'.$search.'%');
                                        });
                            })                        
                            ->paginate();
        //return $filters;
        return Inertia::render('Contacts/Index',compact('contacts','filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $organizations = Organization::all();
        $countries = Country::all();
        //return $organizations;
        return Inertia::render('Contacts/Create', compact('organizations','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //return $request;
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'organization_id' => 'required',
            'email' => 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'state'=> 'required',
            'country_id'=> 'required',
            'postal_code'=> 'required',
        ]);
        $contact = Contact::create($data);
        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {   
        //return $contact;
        $organizations = Organization::all();
        $countries = Country::all();
        //return $contact;
        return Inertia::render('Contacts/Edit', compact('organizations','countries','contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'organization_id' => 'required',
            'email' => 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'state'=> 'required',
            'country_id'=> 'required',
            'postal_code'=> 'required',
        ]);
        $contact->update($data);
        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
