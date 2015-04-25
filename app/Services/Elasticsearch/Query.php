<?php namespace App\Services\Elasticsearch;

use Elasticsearch\Client;

/**
 * Class Query
 *
 * @package App\Services\Elasticsearch
 */
class Query
{
    /**
     * Index of document
     *
     * @var $index
     */
    protected $index;

    /**
     * Type of document
     *
     * @var $type
     */
    protected $type;

    /**
     * The column for search
     *
     * @var string $column
     */
    protected $column;

    /**
     * The parameters to search
     *
     * @var string $param
     */
    protected $param;

    /**
     * The first of document result
     *
     * @var int $from
     */
    protected $from;

    /**
     * The size/limitation of document result
     *
     * @var int $size
     */
    protected $size;

    /**
     * Get the page of document
     *
     * @var int $page
     */
    protected $page;

    /**
     * Get the limitation of document
     *
     * @var int $limit
     */
    protected $limit;

    /**
     * Instance of Client
     */
    public function __construct()
    {
        $this->elastic = new Client();
    }

    /**
     * @param $index
     *
     * @return $this
     */
    public function index($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param $column
     * @param $param
     *
     * @return $this
     */
    public function where($column, $param)
    {
        if (is_null($column) && is_null($param)) {
            $this->column = '';
            $this->param = '';
        }

        $this->column = $column;
        $this->param = $param;

        return $this;
    }

    /**
     * @param $page
     * @param $limit
     *
     * @return $this
     */
    public function limit($page, $limit)
    {
        $this->page = $page;
        $this->limit = (null == $limit) ? 15 : $limit;

        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        $per_page = $this->limit;
        $current_page = $this->page;
        $from = $this->firstItem($current_page, $per_page);

        $searchParams['index'] = $this->index;
        $searchParams['type'] = $this->type;
        $searchParams['from'] = $this->getFirst($from);
        $searchParams['size'] = $this->limit;

        if (null == $this->column) {
            $searchParams['body']['query']['match_all'] = [];
        } elseif (null == $this->param) {
            $searchParams['body']['query']['match_all'] = [];
        } else {
            $searchParams['body']['query']['match'][$this->column] = $this->param;
        }

        $response = $this->elastic->search($searchParams);

        $total = $response['hits']['total'];
        $results = [];

        if (array_get($response, 'hits.hits')) {
            foreach (array_get($response, 'hits.hits') as $hit) {
                $results[] = array_get($hit, '_source');
            }
        }

        return [
            "success"      => $this->getResult($results),
            "total"        => (int)$total,
            "per_page"     => (int)$per_page,
            "current_page" => (int)$current_page,
            "last_page"    => (int)$this->lastPage($total, $per_page),
            "from"         => (int)$this->getFrom($from, $current_page, $this->lastPage($total, $per_page)),
            "to"           => (int)$this->lastItem($total, $current_page, $per_page),
            'data'         => $results
        ];
    }

    /**
     * from = (current_page - 1) * per_page + 1
     *
     * @param $currentPage
     * @param $perPage
     *
     * @return mixed
     */
    public function firstItem($currentPage, $perPage)
    {
        return ($currentPage - 1) * $perPage + 1;
    }

    /**
     * to = min(total,current_page * total)
     *
     * @param $total
     * @param $current_page
     * @param $per_page
     *
     * @return mixed
     */
    public function lastItem($total, $current_page, $per_page)
    {
        return min($total, $current_page * $per_page);
    }

    /**
     * last_page =  (total / per_page) + 1
     *
     * @param $total
     * @param $per_page
     *
     * @return float
     */
    public function lastPage($total, $per_page)
    {
        return ($total / $per_page) + 1;
    }

    /**
     * Get first_item of document
     *
     * @param $from
     *
     * @return mixed
     */
    public function getFirst($from)
    {
        return $from - 1;
    }

    /**
     * @param $from
     * @param $current_page
     * @param $last_page
     *
     * @return mixed
     */
    public function getFrom($from, $current_page, $last_page)
    {
        if ($current_page > $last_page) {
            return $last_page;
        }

        return $from;
    }

    /**
     * @param $result
     *
     * @return string
     */
    public function getResult($result)
    {
        if (empty($result)) {
            return false;
        }

        return true;
    }

}