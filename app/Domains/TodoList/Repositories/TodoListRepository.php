<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Repositories;

use Illuminate\Database\Eloquent\Builder;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListRepositoryInterface;

class TodoListRepository implements TodoListRepositoryInterface
{
    /**
     * @var \LawAdvisor\Domains\TodoList\Interfaces\TodoInterface
     */
    private $model;

    public function __construct(TodoInterface $model)
    {
        $this->model = $model;
    }

    public function getListBuilder(): Builder
    {
        return $this->model->select();
    }
}
