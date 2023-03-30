<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class UserRoleEnum extends Enum
{

    const Admin = 'admin';
    const User = 'user';
    const Seller = 'seller';

    public static function getValues(): array
    {
        return [
            self::Admin,
            self::User,
            self::Seller,
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
            self::Seller => [
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
