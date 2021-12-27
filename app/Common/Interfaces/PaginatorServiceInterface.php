<?php

declare(strict_types=1);

namespace LawAdvisor\Common\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use LawAdvisor\Common\DTOs\PaginatorDTO;

interface PaginatorServiceInterface
{
    /**
     * Add pagination to query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder              $builder
     * @param \LawAdvisor\Common\DTOs\PaginatorDTO                  $dto
     * @param \LawAdvisor\Common\Interfaces\FractalServiceInterface $fractal
     *
     * @return array
     */
    public function paginate(Builder $builder, PaginatorDTO $dto, FractalServiceInterface $fractal): array;
}
