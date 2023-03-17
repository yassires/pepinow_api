<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class UserRoleEnum extends Enum
{

    const Admin = 'admin';
    const User = 'user';

    public static function getValues(): array
    {
        return [
            self::Admin,
            self::User,
        ];
    }

    public function privileges(): array
    {
        return match ($this->value) {
            self::Admin => [
                'edit',
                'insert',
                'delete',
                'view',
            ],
            self::User => [
                'view'
            ]
        };
    }
}
