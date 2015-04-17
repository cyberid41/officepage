<?php namespace App\Services;

use Illuminate\Cache\CacheManager;

/**
 * Class LaraCache
 *
 * @package App\Services
 */
class LaraCache implements LaraCacheInterface
{

    /**
     * @var CacheManager
     */
    protected $cache;

    /**
     * @param CacheManager $cache
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $section
     * @param $key
     *
     * @return mixed
     */
    public function get($section, $key)
    {
        return $this->cache->section($section)->get($key);
    }

    /**
     * @param $section
     * @param $key
     * @param $value
     * @param $minutes
     *
     * @return mixed
     */
    public function put($section, $key, $value, $minutes)
    {
        if (is_null($minutes)) {
            $minutes = $this->minutes;
        }

        return $this->cache->section($section)->put($key, $value, $minutes);
    }

    /**
     * @param $section
     * @param $key
     *
     * @return mixed
     */
    public function has($section, $key)
    {
        return $this->cache->section($section)->has($key);
    }
} 