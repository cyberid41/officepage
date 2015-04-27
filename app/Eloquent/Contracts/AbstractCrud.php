<?php namespace App\Eloquent\Contracts;

/**
 * Class AbstractCrud
 *
 * @package app\Eloquent\Contracts
 */
class AbstractCrud
{
    /**
     * @var CrudInterface
     */
    protected $crud;

    /**
     * @param CrudInterface $crud
     *
     * @return CrudInterface
     */
    public function setCrud(CrudInterface $crud)
    {
        return $this->crud = $crud;
    }
}