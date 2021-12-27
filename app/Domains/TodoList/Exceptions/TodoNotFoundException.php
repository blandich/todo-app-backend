<?php

declare(strict_types=1);

namespace LawAdvisor\Domains\TodoList\Exceptions;

use LawAdvisor\Base\Exceptions\NotFoundHttpException;

class TodoNotFoundException extends NotFoundHttpException
{
}
