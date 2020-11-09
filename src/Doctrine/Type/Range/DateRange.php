<?php
declare(strict_types=1);

namespace Apdata\Db\Doctrine\Type\Range;

use Apdata\Db\Type\Range\DateRange as DateRangeType;
use DateTime;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class DateRange extends Type
{
    public const NAME = 'daterange';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'daterange';
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): DateRangeType
    {
        $lowerBoundChar = $value[0];
        $upperBoundChar = $value[strlen($value) - 1];

        $lowerBound = $lowerBoundChar === '[' ? DateRangeType::BOUNDS_LOWER_INCLUSIVE : DateRangeType::BOUNDS_LOWER_EXCLUSIVE;
        $upperBound = $upperBoundChar === ']' ? DateRangeType::BOUNDS_UPPER_INCLUSIVE : DateRangeType::BOUNDS_UPPER_EXCLUSIVE;

        list($startDate, $endDate) = explode(',', trim($value, '[()]'));

        return new DateRangeType(
            DateTime::createFromFormat('Y-m-d H:i:s', "$startDate 00:00:00"),
            DateTime::createFromFormat('Y-m-d H:i:s', "$endDate 00:00:00"),
            $lowerBound | $upperBound
        );
    }
}
