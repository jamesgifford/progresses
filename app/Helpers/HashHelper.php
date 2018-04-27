<?php

namespace App\Helpers;

use Hashids\Hashids;

class HashHelper
{
    /**
     * Minimum length of encoded keys.
     *
     * @var int
     */
    private static $minLength = '9';

    /**
     * Available characters for encoded keys.
     *
     * @var string
     */
    private static $alphabet = 'abcdefghjkmnpqrstuvwxyz23456789';

    /**
     * Generate a hash value for a key.
     *
     * @param string    $key    the key value to create a hash for
     * @return string
     */
    public static function encodeKey($key)
    {
        $hashids = new Hashids(config('app.salt'), self::$minLength, self::$alphabet);
        
        return($hashids->encode($key));
    }

    /**
     * Get the original key value from a hash.
     *
     * @param string    $key    the hashed key value
     * @return string
     */
    public static function decodeKey($key)
    {
        $hashids = new Hashids(config('app.salt'), self::$minLength, self::$alphabet);

        if (!($decodedKey = $hashids->decode($key))) {
            return;
        }
        
        return($decodedKey[0]);
    }
}
