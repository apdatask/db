<?php
declare(strict_types=1);

namespace Apdata\Db\Type\Range;

use Apdata\Db\Type\AbstractRange;
use DateInterval;
use DatePeriod;
use DateTimeInterface;

class DateRange extends AbstractRange
{
    /**
     * @var DateTimeInterface
     */
    protected $startDate;
    /**
     * @var DateTimeInterface
     */
    protected $endDate;

    public function __construct(DateTimeInterface $startDate, DateTimeInterface $endDate, int $bounds = self::BOUNDS_LOWER_INCLUSIVE | self::BOUNDS_UPPER_EXCLUSIVE)
    {
        parent::__construct($bounds);

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function toDatePeriod(): DatePeriod
    {
        return new DatePeriod($this->startDate, new DateInterval('P1D'), $this->endDate);
    }
}
