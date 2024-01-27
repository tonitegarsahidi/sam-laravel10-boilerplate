<?php
namespace App\Services;

use App\Models\RoleMaster;
use App\Repositories\RoleMasterRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleMasterService
{
    private $roleMasterRepository;

    public function __construct(RoleMasterRepository $roleMasterRepository){
        $this->roleMasterRepository = $roleMasterRepository;
    }

    public function getAllRoles() : Collection
    {
        return $this->roleMasterRepository->getAllRoles();

    }

}
