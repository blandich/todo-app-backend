<?php

declare(strict_types=1);

namespace LawAdvisor\Base\Models;

use Illuminate\Database\Eloquent\Model;
use LawAdvisor\Base\Interfaces\ModelInterface;

abstract class BaseModel extends Model implements ModelInterface
{
    abstract protected static function newFactory();
}
