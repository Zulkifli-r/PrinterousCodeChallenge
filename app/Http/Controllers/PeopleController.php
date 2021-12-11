<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organization\People\StoreAndUpdateRequest;
use App\Models\Organization;
use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $organization)
    {
        return view('organization.people.create-edit', compact('organization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateRequest $request, Organization $organization)
    {
        $person = new Person($request->only('name', 'email', 'phone'));
        if ($request->hasFile('avatar')) {
            $person->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $organization->people()->save($person);

        return redirect()->route('organization.show', $organization)->with('message', 'New Person has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization, Person $person)
    {
        return view('organization.people.create-edit', compact('organization', 'person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateRequest $request,Organization $organization,Person $person)
    {
        $person->update($request->only('name', 'email', 'phone'));
        if ($request->hasFile('avatar')) {
            // remove old media before creating new one
            if ($person->getFirstMedia('avatar')) {
                $person->getFirstMedia('avatar')->delete();
            }
            
            $person->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        return redirect()->route('organization.show', $organization)->with('message', "Person has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization, Person $person)
    {
        $person->delete();
        return redirect()->route('organization.show', $organization)->with('message', 'Person has been deleted.');
    }
}
