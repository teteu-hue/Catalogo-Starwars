<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function getCommentsByEpisodeId()
    {
        if(isset($_GET['id'])){
            if(filter_var($_GET['id'], FILTER_VALIDATE_INT)){
                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
                return $this->sendResponse((new Comment)->show($id));
            } else {
                return $this->sendResponse(["error" => "Algo deu errado, por favor consulte o suporte!"], 404);
            }
        } else {
            return $this->sendResponse((new Comment)->show(null), 404);
        }
    }

    public function store()
    {
        $body = [
            "episode_id" => $_POST['episode_id'],
            "comment" => $_POST['comment']
        ];
        
    }
}
