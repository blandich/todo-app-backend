<?php

declare(strict_types=1);

namespace LawAdvisor\Common\Validators;

use LawAdvisor\Base\Interfaces\ValidatorInterface;

class PaginatorValidator implements ValidatorInterface
{
    public static function rules(): array
    {
        return [
            'page'    => 'int|min:1',
            'perPage' => 'int|min:1',
        ];
    }
}
