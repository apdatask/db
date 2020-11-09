<?php
declare(strict_types=1);

namespace Apdata\Db\Type;

abstract class AbstractRange
{
    public const BOUNDS_LOWER_INCLUSIVE = 2;
    public const BOUNDS_LOWER_EXCLUSIVE = 4;
    public const BOUNDS_UPPER_INCLUSIVE = 8;
    public const BOUNDS_UPPER_EXCLUSIVE = 16;

     /**
      * @var int
      */
    protected $bounds;

    public function __construct(int $bounds)
    {
        $this->bounds = $bounds;
    }

    public function getBounds(): int
    {
        return $this->bounds;
    }
}
