<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Services;

use LawAdvisor\Common\Interfaces\FractalServiceInterface;
use LawAdvisor\Common\Interfaces\PaginatorServiceInterface;
use LawAdvisor\Domains\TodoList\DTOs\TodoListIndexDTO;
use LawAdvisor\Domains\TodoList\DTOs\TodoListStoreDTO;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListRepositoryInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListTransformerInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListServiceInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;

class TodoListService implements TodoListServiceInterface
{
    /**
     * @var \LawAdvisor\Domains\TodoList\Interfaces\TodoListRepositoryInterface
     */
    private $repository;

    /**
     * @var \LawAdvisor\Common\Interfaces\PaginatorServiceInterface
     */
    private $paginator;

    /**
     * @var \LawAdvisor\Common\Interfaces\FractalServiceInterface
     */
    private $fractal;

    public function __construct(
        TodoListRepositoryInterface $repository,
        PaginatorServiceInterface $paginator,
        TodoListTransformerInterface $transformer,
        FractalServiceInterface $fractal
    ) {
        $this->repository = $repository;
        $this->paginator = $paginator;
        $this->fractal = $fractal;
        $this->fractal->setTransformer($transformer);
    }

    public function getListOfTodos(TodoListIndexDTO $dto): array
    {
        $fields = $dto->getFields();
        if ($fields) {
            $this->fractal->include($fields);
        }

        return $this->paginator->paginate(
            $this->repository->getListBuilder(),
            $dto->getPaginatorDTO(),
            $this->fractal
        );
    }

    public function addTask(int $user_id, TodoListStoreDTO $dto): array
    {

        $todo = $this->repository->addTasktoList($user_id,
            $dto->getDetails(),
        );

        return $this->fractal->transformModel($todo);
    }

    public function retrieveTask(TodoInterface $todo): array
    {
        return $this->fractal->transformModel($todo);
    }
}
