<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Interfaces;

use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListStoreDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListUpdateDTO;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;

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

    /**
     * Retrieve Single Task
     *
     * @return array Transformed task data
     */
    public function retrieveTask(TodoInterface $todo): array;

    /**
     * Delete Single Task
     *
     * @return array Transformed task data
     */
    public function deleteTask(TodoInterface $todo): ?string;

    /**
     * Update Single Task
     *
     * @return void
     */
    public function updateTask(TodoInterface $todo, TodoListUpdateDTO $dto): ?string;
}
