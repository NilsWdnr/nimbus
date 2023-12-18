<?php

namespace nimbus\Controller;

use nimbus\Controller;

final class Post extends Controller {
    public function edit(int $id){
        echo "Trying to edit post with the id $id";
    }
}