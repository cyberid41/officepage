<?php namespace App\Elasticsearch\Contracts;

/**
 * Interface DataPribadiElasticsearch
 *
 * @package App\Repositories\Elasticsearch
 */
interface DataPribadiElasticsearch
{
    /**
     * @param $page
     * @param $limit
     * @param $term
     *
     * @return mixed
     */
    public function find($page, $limit, $term);

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
    public function insert(array $data);

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