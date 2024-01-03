<?php

namespace App\Models;

use App\Trait\UuidTrait;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use UuidTrait;
    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'string',
    ];
}
