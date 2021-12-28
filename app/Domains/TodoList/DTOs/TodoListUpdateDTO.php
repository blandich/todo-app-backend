<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\DTOs;

use Illuminate\Http\Request;

class TodoListUpdateDTO
{
    /**
     * @var string Task details
     */
    private $details;

    /**
     * @var int Task priority
     */
    private $priority;

    public function __construct(Request $request)
    {
        $this->details = $request->input('details');
        $this->priority = $request->input('priority');
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }
}
