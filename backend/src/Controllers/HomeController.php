<?php

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('home.view');
    }

    public function test()
    {
        echo 'Voce esta na test!';
    }

    public function update()
    {
        echo 'Voce esta na update';
    }
}