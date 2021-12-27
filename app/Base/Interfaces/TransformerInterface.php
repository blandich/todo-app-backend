<?php

declare(strict_types=1);

namespace LawAdvisor\Base\Interfaces;

interface TransformerInterface
{
    /**
     * Transforms model to return by API.
     *
     * @see https://fractal.thephpleague.com/transformers/
     *
     * @param \LawAdvisor\Base\Interfaces\ModelInterface $model
     *
     * @return array
     */
    public function transform(ModelInterface $model): array;
}
