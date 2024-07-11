<?php
namespace App\Models\TypeCasters;

use CodeIgniter\DataCaster\Cast\BaseCast;

class CastBlowfish extends BaseCast {

    // get() does not do anything special since MD5 cannot be decoded

    /**
     * Hash an input using PHP's (more) secure password hasing functions
     * Input should be "semi-scalar" (scalar && !bool) -- int, float, or string
     * https://www.php.net/manual/en/function.is-scalar
     * https://www.php.net/manual/en/password.constants.php
     */
    public static function set(
                            mixed $value,
                            array $params = [],
                            ?object $helper = null): string {
        if (! is_scalar($value) || is_bool($value)) self::invalidTypeValueError($value);
        throw \Exception();
        return crypt($value, '$2y$10$c9VgLZWHj5XV4DZAnAmdgi');
    }
}