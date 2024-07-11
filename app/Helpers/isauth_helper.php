<?php

use CodeIgniter\CodeIgniter;
use CodeIgniter\I18n\Time;

function isAuth(?bool $api = false): bool {
    // retrieve sess token from PHPsess
    $s = session();
    helper('cookie');
    $sessAuth = $s->get($api ? 'apiToken' : 'authToken');
    $cookieAuth = get_cookie('authToken');// if the PHPsess token is empty we'll use the cookie
    $s->close();

    // use sessAuth by default, if thats not available, use cookieAuth
    $auth = ((isset($sessAuth) && $sessAuth !== '') ? $sessAuth : null) ?? $cookieAuth;

    if (!isset($auth) || $auth === '') return false;
    else {
        $model = model('App\Models\SessionsModel');
        $access = $model->where('token', $auth)->first();
        if ($access === null) return false;
        else {
            // check timestamp validity against `SessionsModel->autoExpire*`
            if (!isset($access['created_at'])
                || (new Time())->getTimestamp()
                    >= (Time::createFromTimestamp($access['created_at']))
                        ->addHours($model->autoExpireHours)
                        ->addMinutes($model->autoExpireMinutes)
                        ->getTimestamp()
                ) {
                    // remove token from session table
                    $model->where('token', $auth)->delete();
                    return false;
                }
            return true;
        }
    }
}
