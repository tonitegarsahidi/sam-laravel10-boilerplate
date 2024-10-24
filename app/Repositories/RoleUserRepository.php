<?php

namespace App\Repositories;

use App\Models\RoleUser;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleUserRepository
{

    //=================================
    // GET ALL ROLES as Collection, to be used in User CRUD
    //=================================

    public function deleteRoleUserByUserId($userId)
    {
        try {
            // Delete all records from role_user where user_id matches $userId
            RoleUser::where('user_id', $userId)->delete();
            return true; // Return true on successful deletion
        } catch (\Exception $e) {
            // Handle any exceptions
            return false; // Return false if deletion fails
        }
    }
}
