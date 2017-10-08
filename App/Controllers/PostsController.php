<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;
use Core\Validator;

class PostsController extends BaseController
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = Container::getModel("Post");
    }

    public function index()
    {
        if (Session::get('success')) {
            $this->view->success = Session::get('success');
            Session::destroy('success');
        }
        if (Session::get('errors')) {
            $this->view->errors = Session::get('errors');
            Session::destroy('errors');
        }
        $this->setPageTitle('Posts');
        $this->view->posts = $this->post->All();
        //$this->view->result = $model->Inserir(uniqid(), "Heldinho", "heldinho@site.com.br");
        $this->renderView('posts/index', 'layout');
    }

    public function show($id)
    {
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

    public function show2($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->post->nome}");
        $this->renderView('posts/show', 'layout');
    }

    public function create()
    {
        $this->setPageTitle("New Post");
        $this->renderView("posts/create", "layout");
    }

    public function store($request)
    {
        $data = [
            'nome' => $request->post->nome,
            'email' => $request->post->email
        ];
        if ($this->post->inserir($data)) {
            return Redirect::route("/posts", [
                'success' => ['Contato inserido com sucesso!']
            ]);
        } else {
            return Redirect::route("/posts", [
                'errors' => ['Error ao inserir Contato!']
            ]);
        }
    }

    public function edit($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("Edit Contato");
        $this->renderView("posts/edit", "layout");
    }

    public function update($id, $request)
    {
        $data = [
            'nome' => $request->post->nome,
            'email' => $request->post->email
        ];

        $id = ['id' => $id]; // maximo um parametro para o where

        $rules = [
            'nome' => 'required',
            'email' => 'email'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator) {
            return Redirect::route("post/{$id}/edit");
        }

        if ($this->post->update($data, $id)) {
            return Redirect::route("/posts", [
                'success' => ['Contato atualizado com sucesso!']
            ]);
        } else {
            return Redirect::route("/posts", [
                'errors' => ['Error ao atualiza Contato!']
            ]);
        }
    }

    public function delete($id)
    {
        if ($this->post->delete($id)) {
            return Redirect::route("/posts", [
                'success' => ['Contato deletado com sucesso!']
            ]);
        } else {
            return Redirect::route("/posts", [
                'errors' => ['Error ao deletar Contato!']
            ]);
        }
    }

}
