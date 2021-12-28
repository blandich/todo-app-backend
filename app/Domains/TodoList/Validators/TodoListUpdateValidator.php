<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Validators;

use LawAdvisor\Base\Interfaces\ValidatorInterface;

class TodoListUpdateValidator implements ValidatorInterface
{
    public static function rules(): array
    {
        return [
            'details'       => 'string|min:3|max:255',
            'priority'      => 'int|min:1',
        ];
    }
}
