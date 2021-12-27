<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Transformers;

use League\Fractal\TransformerAbstract;
use LawAdvisor\Base\Interfaces\ModelInterface;
use LawAdvisor\Domains\TodoList\Interfaces\TodoListTransformerInterface;

class TodoListTransformer extends TransformerAbstract implements TodoListTransformerInterface
{
    public function transform(ModelInterface $model): array
    {
        return [
            'priority'     => $model->priority,
            'details'      => $model->details,
        ];
    }
}
