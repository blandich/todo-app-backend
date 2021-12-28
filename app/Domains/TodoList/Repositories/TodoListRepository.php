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

    public function updateTaskFromList(int $id, int $user_id, string $details = null, int $prevPriority = null, int $priority = null): ?string
    {
        $task = $this->model->where('id', $id)->first();
        if (!is_null($details)) {
            $task->details = $details;
            $task->save();
        }
        if (!is_null($priority)) {
            $tasks = Todo::where('users_id', $user_id)->get()->sortBy('priority');
            dd($tasks);
            $priorities = $tasks->pluck('priority')->toArray();
            if ($priority > max($priorities)) {
                return 'Requested priority exceeded the maximum number of existing task';
            }
            elseif ($priority === $prevPriority) {
                return 'Please choose a different priority number';
            }
            else {
                if ($priority > $prevPriority) {
                    for($i=array_search($prevPriority, $priorities) + 2; $i <= $priority; $i++) {
                        $taskNode = Todo::where('users_id', $user_id)->where('priority', $i)->first();
                        $taskNode->priority = $taskNode->priority - 1;
                        $taskNode->save();
                    }
                }
                else {
                    for($i=$priority; $i < $prevPriority; $i++) {
                        $taskNode = Todo::where('users_id', $user_id)->where('priority', $i)->first();
                        $taskNode->priority = $taskNode->priority + 1;
                        $taskNode->save();
                    }
                }
            }
            $task = Todo::find($id)->update(['priority' => $priority]);
        }

        return null;
    }
}
