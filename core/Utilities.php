<?php

function getAlert(string $alertClass, string $message): string
{
    return '<div class="alert ' . $alertClass . ' alert-fixed" role="alert" data-timeout="5000">' . $message . '</div>';
}
