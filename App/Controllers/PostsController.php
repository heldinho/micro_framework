<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class PostsController extends BaseController {

    public function index() {
        $this->setPageTitle('Posts');
        $model = Container::getModel("Post");
        $this->view->posts = $model->All();
        //$this->view->result = $model->Inserir(uniqid(), "Heldinho", "heldinho@site.com.br");
        $this->renderView('posts/index', 'layout');
    }

    public function show($id) {
        $model = Container::getModel("Post");
        foreach ($this->view->post = $model->find($id) as $post) {
            $jsonArrayPost['dados'][] = array(
                'id' => $post->id,
                'nome' => $post->nome,
                'email' => $post->email
            );
        }
        return json_encode($jsonArrayPost);
        //$this->setPageTitle("{$this->view->post->title}");
        //$this->renderView('posts/show', 'layout');
    }

    public function show2($id) {
        $model = Container::getModel("Post");
        $this->view->post = $model->find($id);
        $this->setPageTitle("{$this->view->post->nome}");
        $this->renderView('posts/show', 'layout');
    }

}
