<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Validators;

use LawAdvisor\Base\Interfaces\ValidatorInterface;

class TodoListIndexValidator implements ValidatorInterface
{
    public static function rules(): array
    {
        return [];
    }
}
