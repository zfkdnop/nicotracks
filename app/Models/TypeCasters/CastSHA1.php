<?php
namespace App\Models\TypeCasters;

use CodeIgniter\DataCaster\Cast\BaseCast;

class CastSHA1 extends BaseCast {

    // get() does not do anything special since MD5 cannot be decoded

    /**
     * Hash an input using SHA1
     * Input should be "semi-scalar" (scalar && !bool) -- int, float, or string
     */
    public static function set(
                            mixed $value,
                            array $params = [],
                            ?object $helper = null): string {
        if (! is_scalar($value) || is_bool($value)) self::invalidTypeValueError($value);

        return sha1($value);
    }
}