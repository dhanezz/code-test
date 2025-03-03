<?php

function getAlert(string $alertClass, string $message): string
{
    // FIXME: add js so that it will append to index.php alert wrapper or else it will disappear with 
    return '<div class="alert ' . $alertClass . ' alert-fixed" role="alert" data-timeout="5000">' . $message . '</div>';
}

function formatToHumanDateTime(string $dateTime): string
{
    $datetimeObj = new DateTime($dateTime);
    return $datetimeObj->format(HUMAN_DATETIME_FORMAT);
}

function formatToCurrency(int|float $number): string
{
    /*
    * FIXME: Rather would have use this, but NumberFormatter won't work, look up ** intl extension **
    *
    * $fmt = new NumberFormatter(LOCALE_CURRENCY, NumberFormatter::CURRENCY);
    * return $fmt->formatCurrency($number, 'EUR');
    */

    return number_format((float)$number, 2, ',', '.');
}
