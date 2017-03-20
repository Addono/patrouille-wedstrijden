<?php
/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 20-3-2017
 */

function dateHasPassed(int $year, int $month, int $day) {
    $now = (new DateTime('now'))->format('U');
    $otherDate = (new DateTime())->setDate($year, $month, $day)->format('U');

    return $now > $otherDate;
}