<?php

/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 7-3-2017
 */
abstract class WeekPage extends PageFrame
{
    /** @var $week */
    protected $week;

    /**
     * The views to be shown.
     *
     * @return array|null Array with the names of the views inbetween the header and footer, null if no views should be shown.
     */
    public function getViews()
    {
        return [
            'week',
        ];
    }

    /**
     * If the page should be visible in the menu.
     *
     * @return boolean
     */
    public function isVisible()
    {
        return true;
    }

    /**
     * Function which is called after construction and before the views are rendered.
     */
    public function beforeView()
    {
        $week = $this->week;
        $this->setData('week', $week);

        $data = $this->ci->Rating->getWeek($week);
        $this->setData('data', $data);
    }

    /**
     * If the current user has access to this page.
     *
     * @return boolean
     */
    public function hasAccess()
    {
        return true;
    }

    /**
     * The form validation rules.
     *
     * @return array|bool
     */
    protected function getFormValidationRules()
    {
        return false;
    }

    /**
     * Defines which models should be loaded.
     *
     * @return array;
     */
    protected function getModels()
    {
        return [
            Rating::class,
        ];
    }

    /**
     * Defines which libraries should be loaded.
     *
     * @return array;
     */
    protected function getLibraries()
    {
        return [];
    }

    /**
     * Defines which helpers should be loaded.
     *
     * @return array;
     */
    protected function getHelpers()
    {
        return [];
    }
}