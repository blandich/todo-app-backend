<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Repositories;

use Illuminate\Database\Eloquent\Builder;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListRepositoryInterface;
use LawAdvisor\Domains\TodoList\Models\Todo;

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

    public function addTaskToList(int $user_id, string $details): Todo
    {
        $priorities = $this->model->where('users_id', $user_id)->select()->pluck('priority')->toArray();
        $latest_prio = count($priorities) > 0 ? max($priorities) : 0;
        $this->model->details = $details;
        $this->model->users_id = $user_id;
        $this->model->priority = $latest_prio + 1;
        $this->model->save();

        return $this->model;
    }
}
