<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Interfaces;

use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListStoreDTO;

interface TodoListServiceInterface
{
    /**
     * Get todo list for account.
     *
     * @param \LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO          $dto
     *
     * @return array Transformed todo list data
     */
    public function getListOfTodos(TodoListIndexDTO $dto): array;

    /**
     * Add Task to the List of Todos
     *
     * @return array Transformed task data
     */
    public function addTask(int $user_id, TodoListStoreDTO $dto): array;
}
