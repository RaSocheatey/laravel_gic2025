<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        // Manager can view tasks/categories in their projects
        if ($user->hasRole('manager')) return true; 
        
        // Staff can only view tasks/categories assigned to them
        if ($user->hasRole('staff')) return $category->assigned_to === $user->id;
        
        return false;
    }

    /**
     * Determine whether the user can update the status.
     * Following TP: Assigned staff only.
     */
    public function updateStatus(User $user, Category $category): bool
    {
        // Assigned staff only
        return $user->hasRole('staff') && $category->assigned_to === $user->id;
    }
}