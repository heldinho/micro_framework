<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class ListarController extends BaseController {

    public function index() {
        $this->setPageTitle('Listar');

        $model = Container::getModel("Post");
        $this->view->posts = $model->All();

        $this->renderView('listar/index', 'layout');
    }

}
