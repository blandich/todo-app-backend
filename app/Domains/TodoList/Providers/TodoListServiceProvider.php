<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Providers;

use Illuminate\Support\ServiceProvider;

class TodoListServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('LawAdvisor\Domains\TodoList\Interfaces\TodoInterface', 'LawAdvisor\Domains\TodoList\Models\Todo');
        $this->app->bind('LawAdvisor\Domains\TodoList\Interfaces\TodoListRepositoryInterface', 'LawAdvisor\Domains\TodoList\Repositories\TodoListRepository');
        $this->app->bind('LawAdvisor\Domains\TodoList\Interfaces\TodoListServiceInterface', 'LawAdvisor\Domains\TodoList\Services\TodoListService');
        $this->app->bind('LawAdvisor\Domains\TodoList\Interfaces\TodoListTransformerInterface', 'LawAdvisor\Domains\TodoList\Transformers\TodoListTransformer');
    }
}
