<?php

declare(strict_types=1);

namespace LawAdvisor\Common\Services;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;
use LawAdvisor\Base\Interfaces\TransformerInterface;
use LawAdvisor\Common\Interfaces\FractalServiceInterface;

class FractalService implements FractalServiceInterface
{
    /**
     * @var \League\Fractal\Manager
     */
    private $fractal;

    /**
     * @var \LawAdvisor\Base\Interfaces\TransformerInterface
     */
    private $transformer;

    public function __construct(Manager $manager)
    {
        $this->fractal = $manager;
    }

    public function transform(ResourceInterface $resource): array
    {
        return $this->fractal->createData($resource)->toArray();
    }

    public function transformCollection($elements): array
    {
        return $this->transform(new Collection($elements, $this->transformer));
    }

    public function transformModel($element): array
    {
        return $this->transform(new Item($element, $this->transformer));
    }

    public function setTransformer(TransformerInterface $transformer): void
    {
        $this->transformer = $transformer;
    }

    public function getTransformer(): TransformerInterface
    {
        return $this->transformer;
    }

    public function include(string $name): void
    {
        $this->fractal->parseIncludes($name);
    }

    public function extend(string $name): void
    {
        $method = 'set' . ucfirst($name);
        $this->transformer->$method();
    }

    public function exclude(string $name): void
    {
        $this->fractal->parseExcludes($name);
    }
}
