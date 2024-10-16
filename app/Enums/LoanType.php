<?php

namespace App\Enums;

enum LoanType: string
{
    case HOUSING = 'housing';
    case MULTI_PURPOSE = 'multi_purpose';
    case CALAMITY = 'calamity';
}
