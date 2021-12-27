<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LawAdvisor\Base\Controllers\Controller;
use LawAdvisor\Common\Validators\PaginatorValidator;
use LawAdvisor\Domains\TodoList\Validators\TodoListIndexValidator;
use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListServiceInterface;

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
     * Retrieve list of accounts.
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
}
