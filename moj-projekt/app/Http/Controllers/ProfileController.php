<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Project;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, Project $project)
{
    $user = $request->user();

    if ($project->owner_id == $user->id) {
        // Voditelj može mijenjati sve
        $project->update($request->all());
    } elseif ($project->members->contains($user)) {
        // Član tima može mijenjati samo obavljene poslove
        $project->update($request->only('completed_tasks'));
    } else {
        abort(403, 'Nemaš ovlasti za ovaj projekt.');
    }

    return redirect()->route('projects.show', $project);
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
   

public function show()
{
    $user = Auth::user();

    // Projekti koje je korisnik otvorio (voditelj)
    $owned = $user->ownedProjects;

    // Projekti gdje je korisnik član tima
    $member = $user->teamProjects;

    return view('profile.show', compact('user', 'owned', 'member'));
}

}
