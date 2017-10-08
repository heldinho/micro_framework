<?php

namespace App\Models;

use Core\BaseModel;

class Post extends BaseModel
{

    protected $table = "contato";

    public function setNomeEmail($nome, $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

}
