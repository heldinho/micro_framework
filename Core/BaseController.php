<?php

namespace Core;

abstract class BaseController {

    protected $view;
    private $ViewPath;
    private $LayoutPath;
    private $pageTitle = null;

    public function __construct() {
        $this->view = new \stdClass;
    }

    protected function renderView($viewPath, $layoutPath = null) {
        $this->ViewPath = $viewPath;
        $this->LayoutPath = $layoutPath;
        if ($layoutPath) {
            $this->layout();
        } else {
            $this->content();
        }
    }

    protected function content() {
        if (file_exists(__DIR__ . "/../App/Views/{$this->ViewPath}.phtml")) {
            require(__DIR__ . "/../App/Views/{$this->ViewPath}.phtml");
        } else {
            echo "Error: View path not found!";
        }
    }

    protected function layout() {
        if (file_exists(__DIR__ . "/../App/Views/{$this->LayoutPath}.phtml")) {
            require(__DIR__ . "/../App/Views/{$this->LayoutPath}.phtml");
        } else {
            echo "Error: Layout path not found!";
        }
    }

    protected function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
    }

    protected function getPageTitle($separator = null) {
        if (isset($separator)) {
            echo $this->pageTitle . ' ' . $separator . ' ';
        } else {
            echo $this->pageTitle . ' ';
        }
    }

}
