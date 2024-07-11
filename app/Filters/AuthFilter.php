<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface {
    
    /**
     * verify authorization status before proceeding with a controller
     */
    public function before(RequestInterface $req, $args = null) {
        // $auth = service('authcontroller');
        helper('isauth');
        if (isAuth() === false) return redirect()->to(site_url('error')); // returning a view here doesn't work per https://codeigniter.com/user_guide/incoming/filters.html#stopping-later-filters
        else return;
    }

    /**
     * 
     */
    public function after(RequestInterface $req, ResponseInterface $resp, $args = null) {
        // return $resp;
    }
}