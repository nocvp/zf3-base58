<?php
/**
 * Created by PhpStorm.
 * User: semihs
 * Date: 13.08.2016
 * Time: 11:08
 */

namespace Base58\Service;

/**
 * Class Base58Service
 * @package Base58\Service
 */
class Base58Service
{
    /**
     * @var array
     */
    private $options = array();

    /**
     * Base58Service constructor.
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function random()
    {
        return $this->encode($this->milliseconds() . rand(1000, 9999));
    }

    /**
     * @param $num int
     * @return string
     */
    public function encode($num)
    {
        $alphabet = str_split($this->options['alphabet']);
        $base_count = count($alphabet);
        $encoded = '';
        while ($num >= $base_count) {
            $div = $num / $base_count;
            $mod = ($num - ($base_count * intval($div)));
            $encoded = $alphabet[$mod] . $encoded;
            $num = intval($div);
        }
        if ($num) {
            $encoded = $alphabet[$num] . $encoded;
        }
        return $encoded;
    }

    /**
     * @param $num
     * @return int
     */
    public function decode($num)
    {
        $alphabet = $this->options['alphabet'];
        $len = strlen($num);
        $decoded = 0;
        $multi = 1;
        for ($i = $len - 1; $i >= 0; $i--) {
            $decoded += $multi * strpos($alphabet, $num[$i]);
            $multi = $multi * strlen($alphabet);
        }
        return $decoded;
    }

    /**
     * @return int
     */
    public function milliseconds()
    {
        return round(microtime(true) * 1000);
    }
}