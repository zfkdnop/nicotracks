<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class AuthLoginController extends BaseController {
    // protected $modelName    = '';
    protected $usersModel       = 'App\Models\UsersModel';
    protected $sessionsModel    = 'App\Models\SessionsModel';
    protected $helpers = ['isauth'];

    public function loginForm(): string {
        helper('form');
        $d = [
            'title' => 'Login',
            // 'auth' => service('authcontroller')->isAuth(),
            'auth' => isAuth(),
        ];
        return view('templates/header')
            . view('pages/auth/login/loginForm', $d)
            . view('templates/footer');
    }

    // Perform login functions & interact with database
    public function login(): string {
        // TODO: implement rate-limiting
        $algo = 'sha256';
        $cost = 14;
        // $pw = '';
        // $testhash = hash_hmac($algo, 'fakepw', 'fakesalt'); // determine the strlen of this algo's hashes
        // $salt = random_bytes(strlen($testhash)); // make the salt equal in length to the prehash length
        // password_hash(hash_hmac($algo, $pw, $salt), PASSWORD_BCRYPT, ['cost' => $cost])

        $usersModel  = model($this->usersModel);

        // get raw inputs & validate/sanitize
        $inputs = $this->request->getPost(['username', 'passwd']);
        if (!$this->validateData($inputs, $usersModel->userLoginValidation))
            return $this->index();
        $inputs = $this->validator->getValidated();

        // find user login information
        $userRow = $usersModel->where('username', esc($inputs['username']))->first();
        if ($userRow !== null) {  // found the user
            $inputprehash = hash_hmac($algo, $inputs['passwd'], hex2bin($userRow['salt']));
            //$inputhash = password_hash(hash_hmac($algo, $inputs['passwd'], hex2bin($userRow['salt'])), PASSWORD_BCRYPT, ['cost' => $cost]);
            $access = password_verify($inputprehash, $userRow['passwd']); // test the passwords using timing-safe func
            if ($access === true) { // pw's match
                $sessModel = model($this->sessionsModel); // get handle on the `sessions` table
                $newSess = [ // generate a new session/token
                    'userid'    => $userRow['id'],
                    'token'     => hash_hmac($algo, implode('+', $userRow).'+'.(new Time())->getTimestamp(), $userRow['salt']),
                    'ip'        => $this->request->getIPAddress(),
                    // 'deleted_at'=> (Time::parse('+24 hours'))->getTimestamp(),
                ];
                $sessModel->save($newSess); // insert new session into `sessions` table
                $s = session();
                helper('cookie');
                $s->set('authToken', $newSess['token']); // update the the PHP session with the newly-created session token
                set_cookie('authToken', $newSess['token'], 
                        Time::parse('+'.$sessModel->autoExpireHours.' hours '.$sessModel->autoExpireMinutes.' minutes')->getTimestamp()); // and update the browser cookie for fallback
                $s->close();
            } else return $this->index();
        } else return $this->index();

        return view('templates/header')
            . view('pages/auth/login/success')
            . view('templates/footer');
    }

    public function logout(): string {
        if (isauth() === true) {
            // retrieve sess token from PHPsess
            $s = session();
            helper('cookie');
            $sessAuth = $s->get('authToken');   // TODO `apiToken`?
            $cookieAuth = get_cookie('authToken'); // if the PHPsess token is empty we'll use the cookie

            $s->set('authToken', ''); // remove the session token from PHPsess & cookie
            $s->remove('authToken');
            set_cookie('authToken', '');
            $s->close();

            // use sessAuth by default, if thats not available, use cookieAuth
            $auth = ((isset($sessAuth) && $sessAuth !== '') ? $sessAuth : null) ?? $cookieAuth;

            // remove token from session table
            $model = model('App\Models\SessionsModel');
            $model->where('token', $auth)->delete();
        }

        return view('templates/header')
            . view('pages/auth/login/success')
            . view('templates/footer');
    }
}