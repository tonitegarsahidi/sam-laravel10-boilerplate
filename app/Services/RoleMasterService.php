<?php
namespace App\Services;

use App\Repositories\RoleMasterRepository;
use Illuminate\Database\Eloquent\Collection;

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
