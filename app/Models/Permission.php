<?php

namespace App\Models;

use App\Trait\UuidTrait;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use UuidTrait;
    protected $primaryKey = 'id';
}
