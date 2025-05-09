<?php

namespace App\Policies;

use App\Models\FeedbackResult;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class FeedbackResultPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FeedbackResult $feedbackResult): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user === Auth::user();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FeedbackResult $feedbackResult): bool
    {
        return $feedbackResult->dishChoice->user->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FeedbackResult $feedbackResult): bool
    {
        return $feedbackResult->dishChoice->user->id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FeedbackResult $feedbackResult): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FeedbackResult $feedbackResult): bool
    {
        return false;
    }
}
