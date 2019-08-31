<?php
/**
 * Utilites classes that doesn't belong to anything else.
 * PHP version 7.2
 *
 * @category description
 * @package  PilaLib
 * @author   John Pilar <pilarjan4111@gmail.com>
 * @license  GPL-3.0
 *           https://github.com/pilarik31/project-template/blob/master/LICENSE
 * @link     https://github.com/pilarik31/project-template
 */

namespace PilaLib\Classes;

class Utilities
{
    /**
     * Function to test 'require' of this namespace.
     *
     * @return string Hello there!
     */
    public function helloThere()
    {
        return "Hello there!";
    }

    /**
    * Generate a random string, using a cryptographically secure
    * pseudorandom number generator (random_int)
    *
    * This function uses type hints now (PHP 7+ only), but it was originally
    * written for PHP 5 as well.
    *
    * For PHP 7, random_int is a PHP core function
    * For PHP 5.x, depends on https://github.com/paragonie/random_compat
    *
    * @param int $length      How many characters do we want?
    * @param string $keyspace A string of all possible characters
    *                         to select from
    * @return string
    */
    public function randomStr(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $imageSet Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param bool $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return string containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($email, $size = 80, $imageSet = 'mp', $rating = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$imageSet&r=$rating";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }

    public function getClientLanguage($availableLanguages, $default = 'en')
    {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    
            foreach ($langs as $value) {
                $choice = substr($value, 0, 2);
                if (in_array($choice, $availableLanguages)) {
                    return $choice;
                }
            }
        }
        return $default;
    }

    public function getEurToCzk(float $eur = null)
    {
        $url = "https://api.exchangeratesapi.io/latest?base=EUR&symbols=CZK";

        if ($eur == null || empty($eur)) {
            $json = file_get_contents($url);
            $jsonData = json_decode($json, true);
            return round($jsonData['rates']['CZK'], 2);
        } elseif (!empty($eur)) {
            $json = file_get_contents($url);
            $jsonData = json_decode($json, true);
            
            $value = $eur * $jsonData['rates']['CZK'];
            return round($value, 2);
        }
    }
}
