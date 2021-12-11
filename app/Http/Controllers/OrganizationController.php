<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organization\StoreAndUpdateRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateRequest $request)
    {
        $organization = new Organization($request->only('name', 'phone','email','website'));
        if ($request->hasFile('logo')) {
            $organization->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
        $organization->save();

        return redirect()->route('home')->with('message', __('Organization has been created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $organization->load('people');
        return view('organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('organization.create-edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateRequest $request, Organization $organization)
    {
        $organization->update($request->only('name','email', 'phone', 'website'));
        if ($request->hasFile('logo')) {
            if ($organization->getFirstMedia('logo')) {
                $organization->getFirstMedia('logo')->delete();
            }
            $organization->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        return redirect()->route('organization.show', $organization)->with('message', __('Organizatin has been updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return redirect()->route('home')->with('message', __('Organization has been deleted.'));
    }
}
