<?php

namespace App\Enums;

enum Role: string
{
    case USER = 'user';
    case ADMINISTRATOR = 'admin';
}
