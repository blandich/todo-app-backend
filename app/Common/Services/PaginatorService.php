<?php

declare(strict_types=1);

namespace LawAdvisor\Common\Services;

use Illuminate\Database\Eloquent\Builder;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use LawAdvisor\Common\DTOs\PaginatorDTO;
use LawAdvisor\Common\Interfaces\FractalServiceInterface;
use LawAdvisor\Common\Interfaces\PaginatorServiceInterface;

class PaginatorService implements PaginatorServiceInterface
{
    /**
     * @const string[]
     */
    public const DEFAULT_COLUMNS = ['*'];

    /**
     * @const string
     */
    public const DEFAULT_PAGENAME = 'page';

    public function paginate(Builder $builder, PaginatorDTO $dto, FractalServiceInterface $fractal): array
    {
        if ($dto->getSort()) {
            $builder->sort($dto->getSort());
        }

        $paginator = $builder->paginate(
            $dto->getPerPage(),
            self::DEFAULT_COLUMNS,
            self::DEFAULT_PAGENAME,
            $dto->getPage()
        );
        $list = $paginator->getCollection();

        $resource = new Collection($list, $fractal->getTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $fractal->transform($resource);
    }
}
