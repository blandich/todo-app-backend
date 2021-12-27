<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\DTOs;

use Illuminate\Http\Request;

class TodoListStoreDTO
{
    /**
     * @var string Period ref. code
     */
    private $details;

    public function __construct(Request $request)
    {
        $this->details = $request->input('details');
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }
}
