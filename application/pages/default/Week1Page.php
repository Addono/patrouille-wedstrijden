<?php

/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 20-3-2017
 */
class Week1Page extends WeekPage
{
    public function __construct($validateForm = true)
    {
        $this->week = 1;
        parent::__construct($validateForm);
    }
}