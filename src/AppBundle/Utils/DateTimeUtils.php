<?php

namespace AppBundle\Utils;

class DateTimeUtils
{
    public static function getYearBeginning(int $year): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', "$year-1-1 00:00:00");
    }

    public static function getYearEnd(int $year): \DateTime
    {
        $year++;

        return \DateTime::createFromFormat('Y-m-d H:i:s', "$year-1-1 00:00:00")
            ->modify('-1 second');
    }
}
