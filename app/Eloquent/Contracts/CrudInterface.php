<?php namespace App\Eloquent\Contracts;

/**
 * Interface CrudInterface
 *
 * @package App\Eloquent\Contracts
 */
interface CrudInterface
{

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function find(array $data);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findById($id);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id);

}