<?php

declare(strict_types=1);

namespace App\Enum\Users;

use MyCLabs\Enum\Enum;

final class Role extends Enum
{
    private const ADMIN = 'admin';
    private const STAFF = 'staff';
}
