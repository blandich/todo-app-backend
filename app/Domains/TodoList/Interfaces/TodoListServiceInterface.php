<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Interfaces;

use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;

interface TodoListServiceInterface
{
    /**
     * Get todo list for account.
     *
     * @param \LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO          $dto
     *
     * @return array Transformed period data
     */
    public function getListOfTodos(TodoListIndexDTO $dto): array;
}
