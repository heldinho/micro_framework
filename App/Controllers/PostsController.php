<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;

class PostsController extends BaseController {

    private $post;

    public function __construct() {
        parent::__construct();
        $this->post = Container::getModel("Post");
    }

    public function index() {
        $this->setPageTitle('Posts');
        $this->view->posts = $this->post->All();
        //$this->view->result = $model->Inserir(uniqid(), "Heldinho", "heldinho@site.com.br");
        $this->renderView('posts/index', 'layout');
    }

    public function show($id) {
        foreach ($this->view->post = $this->post->find($id) as $post) {
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
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->post->nome}");
        $this->renderView('posts/show', 'layout');
    }

    public function create() {
        $this->setPageTitle("New Post");
        $this->renderView("posts/create", "layout");
    }

    public function store($request) {
        $data = [
            'id' => $request->post->id,
            'nome' => $request->post->nome,
            'email' => $request->post->email
        ];
        if ($this->post->inserir($data)) {
            Redirect::route("/posts");
        } else {
            echo "Erro ao inserir no banco de dados";
        }
    }

}
