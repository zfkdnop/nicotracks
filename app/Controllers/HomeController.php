<?php

namespace App\Controllers;

use CodeIgniter\Cookie\Cookie;
use CodeIgniter\I18n\Time;

class HomeController extends BaseController {
    // protected $modelName    = 'App\Models\DataPointModel';
    protected $dataPointModel   = 'App\Models\DataPointModel';
    // protected $usersModel       = 'App\Models\UsersModel';
    // protected $sessionsModel    = 'App\Models\SessionsModel';
    // protected $helpers = ['isauth'];

    public function home(): string {
        // $d = [
        //         'title' => 'sup dawg',
        //         // 'auth' => service('authcontroller')->isAuth(),
        //         'auth' => isAuth(),
        //     ];
        return view('templates/header')
            . view('pages/home', ['title' => 'sup dawg'])
            . view('templates/footer');
    }
}
