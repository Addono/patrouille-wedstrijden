<?php

/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 3-3-2017
 */
class Menu extends MenuFrame
{

    protected function menuElements() {
        return [
            new MenuPage('Week 1', WeekPage::class, null, [1]),
            new MenuPage('Week 2', WeekPage::class, null, [2]),
            new MenuPage('Week 3', WeekPage::class, null, [3]),
            new MenuPage('Week 4', WeekPage::class, null, [4]),
        ];
    }

    function getListItemHtml($title, $link, $icon) {
        $iconHtml = $this->getIconHtml($icon);
        $linkHtml = $link===null?$title:'<a href="'.$link.'">'.$iconHtml.$title.'</a>';

        return '<li>'.$linkHtml.'</li>';
    }

    function getSubMenuHtml($title, $icon, $content, $level) {
        $iconHtml = $this->getIconHtml($icon);
        switch ($level) {
            case 0:
                return "<ul class=\"nav navbar-nav\">\n" . $content . "</ul>\n";
                break;
            default:
                return '<li class="dropdown">'
                        . '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $iconHtml . $title
                            . '<b class="caret"></b>'
                        . '</a>'
                        . '<ul class="dropdown-menu dropdown-menu-right">'.$content.'</ul>'
                    . '</li>';
                break;
        }
    }

    private function getIconHtml($icon) {
        if ($icon === null) {
            return '';
        } else {
            return '<i class="' . $icon . '"></i> ';
        }
    }
}