<?php

//require_once('/../Controllers/PostsController.php');

namespace App\Ajax;

use App\Controllers\PostsController;

$postcontroller = new PostsController();

if (isset($_POST['acao'])) {

    $acao = $_POST['acao'];

    switch ($acao) {
        case 'show': {
            $idPost = $_POST['id'];
            echo $postcontroller->show($idPost);
        }
            break;
    }
}
