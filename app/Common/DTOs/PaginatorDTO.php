<?php

declare(strict_types=1);

namespace LawAdvisor\Common\DTOs;

use Illuminate\Http\Request;

class PaginatorDTO
{
    /**
     * @const int default number of pages
     */
    public const DEFAULT_PERPAGE = 15;

    /**
     * @const string sort order ascending
     */
    public const SORT_ORDER_ASC = 'ASC';

    /**
     * @const string sort order descending
     */
    public const SORT_ORDER_DESC = 'DESC';

    /**
     * @var int Page number
     */
    private $page;

    /**
     * @var int Amount of records per page
     */
    private $perPage;

    /**
     * @var array sort configuration
     */
    private $sort;

    public function __construct(Request $request)
    {
        $this->page = (int) $request->input('page', 1);
        $this->perPage = (int) $request->input('perPage', self::DEFAULT_PERPAGE);
        $this->sort = (array) $request->input('sort');
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getSort(): ?array
    {
        return $this->sort;
    }
}
