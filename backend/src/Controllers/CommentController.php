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
                $response = (new Comment)->show($id);

                if(!$response){
                    return $this->sendResponse(["error" => "Esse episodio nao existe!"], 404);
                }

                return $this->sendResponse($response);
            } else {
                return $this->sendResponse(["error" => "Algo deu errado, por favor consulte o suporte!"], 404);
            }
        } else {
            return $this->sendResponse((new Comment)->show(null), 404);
        }
    }

    public function store()
    {
        /**
         * (null && null) = false 
         * (null && null) === false = true
         */
        if((isset($_POST['episode_id']) && isset($_POST['comment'])) === false){
            return $this->sendResponse([
                "error" => "Por favor, contate o suporte!"
            ], 400);
        }
        $data = [
            ":episode_id" => $_POST['episode_id'],
            ":comment" => $_POST['comment'] 
        ];
        $response = (new Comment)->create($data);

        if($response){
            return $this->sendResponse([
                "status" => true,
                "message" => "Obrigado pelo comentário!"
            ], 200);
        }
        return $this->sendResponse([
            "status" => false,
            "message" => "Por favor, contate o suporte!"
        ], 500);

    }
}


