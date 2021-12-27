<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use LawAdvisor\Base\Interfaces\RepositoryInterface;
use LawAdvisor\Domains\TodoList\Models\Todo;
// use LawAdvisor\Domains\Accounts\Interfaces\AccountInterface;

interface TodoListRepositoryInterface extends RepositoryInterface
{
    public function __construct(TodoInterface $model);

    /**
     * Get list of todo for provided account.
     *
     * @param \LawAdvisor\Domains\Accounts\Interfaces\AccountInterface $account
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getListBuilder(): Builder;

    /**
     * Add a task at the end of todo list
     *
     * @param int $user_id
     * @param string $details
     *
     * @return \LawAdvisor\Domains\TodoList\Models\Todo;
     */
    public function addTaskToList(int $user_id, string $details): Todo;
}
