<?php

namespace LawAdvisor\Common\Interfaces;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;
use LawAdvisor\Base\Interfaces\TransformerInterface;

interface FractalServiceInterface
{
    public function transform(ResourceInterface $resource): array;

    public function transformCollection($elements): array;

    public function transformModel($element): array;

    public function setTransformer(TransformerInterface $transformer): void;

    public function include(string $name): void;

    public function extend(string $name): void;

    public function exclude(string $name): void;
}
