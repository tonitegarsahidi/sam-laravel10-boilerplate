<?php

namespace App\Repositories;

use App\Models\RoleMaster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleMasterRepository
{

    //=================================
    // GET ALL ROLES as Collection, to be used in User CRUD
    //=================================
    public function getAllRoles(): Collection
    {
        return RoleMaster::all();
    }


    public function getRoleMasterById(int $RoleMasterId): ?RoleMaster
    {
        return RoleMaster::find($RoleMasterId);
    }
}
