<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\DTOs;

use Illuminate\Http\Request;
use LawAdvisor\Common\DTOs\PaginatorDTO;

class TodoListIndexDTO
{
    /**
     * @var \LawAdvisor\Common\DTOs\PaginatorDTO
     */
    private $paginatorDTO;

    /**
     * @var string fields to be included
     */
    private $fields;

    public function __construct(Request $request)
    {
        $this->paginatorDTO = new PaginatorDTO($request);
        $this->fields = $request->input('fields');
    }

    public function getPaginatorDTO(): PaginatorDTO
    {
        return $this->paginatorDTO;
    }

    public function getFields(): ?string
    {
        return $this->fields;
    }
}
