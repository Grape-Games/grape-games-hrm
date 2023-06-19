<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EmployeeStatusEnum extends Enum
{
    const ACTIVE =   'active';
    const INACTIVE =   'inactive';
}
