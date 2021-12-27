<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Models;

// use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LawAdvisor\Base\Models\BaseModel;
use LawAdvisor\Domains\TodoList\Interfaces\TodoInterface;

class Todo extends BaseModel implements TodoInterface
{
    protected $table = 'todo_list';

    protected $fillable = ['priority', 'details'];

    protected static function newFactory()
    {
        return null;
    }
}
