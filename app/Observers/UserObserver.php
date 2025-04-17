<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user)
    {
        Log::info('User created', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_by' =>Auth::id()
        ]);
    }

    public function updated(User $user)
    {
        Log::info('User updated', [
            'user_id' => $user->id,
            'changes' => $user->getChanges(),
            'updated_by' => Auth::id()
        ]);
    }

    public function deleted(User $user)
    {
        Log::info('User deleted', [
            'user_id' => $user->id,
            'deleted_by' => Auth::id()
        ]);
    }
}