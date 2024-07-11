<?php
namespace App\Models\TypeCasters;

use CodeIgniter\DataCaster\Cast\BaseCast;
// use InvalidArgumentException;

class CastMD5 extends BaseCast {

    // get() does not do anything special since MD5 cannot be decoded

    public static function set(
                            mixed $value,
                            array $params = [],
                            ?object $helper = null): string {
        if (! is_string($value)) self::invalidTypeValueError($value);

        return md5($value);
    }
}