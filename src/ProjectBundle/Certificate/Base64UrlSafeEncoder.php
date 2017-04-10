<?php
/**
 * Base64Encoder.php
 *
 * @since 10/04/17
 * @author gseidel
 */

namespace ProjectBundle\Certificate;


class Base64UrlSafeEncoder
{
    public static function encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    public static function decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }
}