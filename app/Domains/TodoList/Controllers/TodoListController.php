<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LawAdvisor\Base\Controllers\Controller;
use LawAdvisor\Common\Validators\PaginatorValidator;
use LawAdvisor\Domains\TodoList\Validators\TodoListIndexValidator;
use LawAdvisor\Domains\TodoList\Validators\TodoListStoreValidator;
use LawAdvisor\Domains\TodoList\Validators\TodoListUpdateValidator;
use LawAdvisor\Domains\TodoList\DTOs\TodoListStoreDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListUpdateDTO;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListServiceInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;

class TodoListController extends Controller
{
    /**
     * @var \LawAdvisor\Domains\TodoList\Interfaces\TodoListServiceInterface
     */
    private $service;

    public function __construct(
        TodoListServiceInterface $service
    ) {
        $this->service = $service;
    }

    /**
     * Retrieve list of todos.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validators = array_merge(
            TodoListIndexValidator::rules(),
            PaginatorValidator::rules(),
        );
        $this->validate($request, $validators);

        $dto = new TodoListIndexDTO($request);
        $response = $this->service->getListOfTodos($dto);

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }

    /**
     *  Add a task in the list of todos
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, TodoListStoreValidator::rules());

        $dto = new TodoListStoreDTO($request);
        $response = $this->service->addTask(1, $dto);

        return new JsonResponse($response, JsonResponse::HTTP_CREATED);
    }

    /**
     * Retrieve single task.
     *
     * @param \LawAdvisor\Domains\TodoList\Interfaces\TodoInterface $todo
     * @param \Illuminate\Http\Request                            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function retrieve(TodoInterface $todo): JsonResponse
    {
        $response = $this->service->retrieveTask($todo);

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }

    /**
     * Delete single task.
     *
     * @param \LawAdvisor\Domains\TodoList\Interfaces\TodoInterface $todo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(TodoInterface $todo): JsonResponse
    {
        $result = $this->service->deleteTask($todo);

        if ($result) {
            return new JsonResponse(['error' => $result], JsonResponse::HTTP_CONFLICT);
        }

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Update single task.
     *
     * @param \LawAdvisor\Domains\TodoList\Interfaces\TodoInterface $todo
     * @param \Illuminate\Http\Request                            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TodoInterface $todo, Request $request): JsonResponse
    {
        $this->validate($request, TodoListUpdateValidator::rules());

        $dto = new TodoListUpdateDTO($request);
        $result = $this->service->updateTask($todo, $dto);

        if ($result) {
            return new JsonResponse(['error' => $result], JsonResponse::HTTP_CONFLICT);
        }

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

}
