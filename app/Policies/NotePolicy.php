<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('master_admin')) {
            return true;
        }
    }


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Note       $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        if ($user->id == $note->user->id) {
            return true;
        }

        return false;
    }
}
