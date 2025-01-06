<?php

namespace App\Enum;

enum SessionIsNewEnum: int
{
    case EXISTS = 0;
    case NEW = 1;
}
