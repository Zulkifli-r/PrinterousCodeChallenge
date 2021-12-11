<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $organizations = Organization::query()
                    ->when($request->keyword, function($q) use($request) {
                        return $q->where('name','like',"%$request->keyword%")->orWherehas('people', function($q) use ($request) {
                            return $q->where('name', 'like', "%$request->keyword%");
                        });
                    })
                    ->latest()
                    ->withCount('people')
                    ->paginate(6);
        
        return view('dashboard', compact('organizations'));
    }
}
