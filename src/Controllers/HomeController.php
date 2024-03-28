<?php

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('index');
    }

    public function show($save)
    {
        return $this->render('index', ['save' => $save]);
    }
}