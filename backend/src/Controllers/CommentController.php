<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function getCommentsByEpisodeId()
    {
        return $this->sendResponse((new Comment)->show(4));
    }

    public function store()
    {
        $body = [
            "episode_id" => $_POST['episode_id'],
            "comment" => $_POST['comment']
        ];
        
    }
}
