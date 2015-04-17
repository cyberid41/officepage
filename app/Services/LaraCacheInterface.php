<?php namespace App\Services;

/**
 * Interface LaraCacheInterface
 *
 * @package App\Services
 */
interface LaraCacheInterface
{

    /**
     * @param $section
     * @param $key
     *
     * @return mixed
     */
    public function get($section, $key);

    /**
     * @param $section
     * @param $key
     * @param $value
     * @param $minutes
     *
     * @return mixed
     */
    public function put($section, $key, $value, $minutes);

    /**
     * @param $section
     * @param $key
     *
     * @return mixed
     */
    public function has($section, $key);
} 