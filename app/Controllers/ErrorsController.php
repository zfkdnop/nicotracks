<?php

namespace App\Controllers;

class ErrorsController extends BaseController {
    // protected $modelName    = 'App\Models\DataPointModel';

    public function index(?string $title = 'Access denied', ?string $message = 'You do not have access to view this page'): string {
        return view('templates/header')
            . view('errors/exception', ['title'=>$title, 'message'=>$message])
            . view('templates/footer');
    }
}