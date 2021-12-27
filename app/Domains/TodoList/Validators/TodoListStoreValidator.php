<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Validators;

use LawAdvisor\Base\Interfaces\ValidatorInterface;

class TodoListStoreValidator implements ValidatorInterface
{
    public static function rules(): array
    {
        return [
            'details'    => 'required|string|min:3|max:255',
        ];
    }
}
