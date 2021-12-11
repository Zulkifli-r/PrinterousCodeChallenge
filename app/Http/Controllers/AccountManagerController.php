<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $organization)
    {
        $users = User::doesnthave('organization')->isAdmin(false)->get();
        
        return view('organization.account-manager.create', compact('organization', 'users'));
    }

    public function store(Organization $organization, User $user)
    {
        $organization->update(['user_id' => $user->id]);
        return redirect()->route('organization.show', $organization)->with('message', __('Account manager has been assigned.'));
    }

    public function destroy(Organization $organization)
    {
        $organization->update(['user_id' => null]);

        return redirect()->route('organization.show', $organization)->with('message', __('Account manager has been unassigned'));
    }
}
