<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
  
        public function show()
        {
            $user = Auth::user();
            return view('profile.show', compact('user'));
        }
    
        public function edit()
        {
            $user = Auth::user();
            return view('profile.edit', compact('user'));
        }
        /**
     * Update the user's profile information.
     */
    
    
        public function update(ProfileUpdateRequest $request)
        {
            $user = Auth::user();
            $data = $request->validated();
    
            // Handle profile image upload
         
            if (isset($data['profile_image'])) {
                if ($user->profile_image) {
                    //Delete current Profile
                    Storage::delete($user->profile_image);
                }
                $data['profile_image'] = $this->uploadPhoto($data['profile_image']);
            }
             $data['owner_id'] = Auth::id();
    
            $user->update($data);
    
            return redirect()->route('profile.show')
                ->with('success', 'Profile updated successfully.');
        }
    

        protected function uploadPhoto($photo): string
        {
            $path = $photo->store('profile-images', 'public');
            return $path;
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
}
