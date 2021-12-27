<?php

declare(strict_types=1);

namespace LawAdvisor\Providers;

use mmghv\LumenRouteBinding\RouteBindingServiceProvider as BaseServiceProvider;
use LawAdvisor\Domains\TodoList\Exceptions\TodoNotFoundException;

class RouteBindingServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->binder->bind('todo', 'LawAdvisor\Domains\TodoList\Models\Todo@resolveRouteBinding', function () {
            throw new TodoNotFoundException('Task not found');
        });
    }
}
