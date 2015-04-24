<?php namespace App\Elasticsearch;

use Elasticsearch\Client;

/**
 * Class AbstractElasticsearch
 *
 * @package App\Repositories
 */
class AbstractElasticsearch
{
    /**
     * @var string
     */
    protected $index = 'app_index';

    /**
     * @var string
     */
    protected $type = 'app_type';

    /**
     * Create a new
     */
    public function __construct()
    {
        $this->elastic = new Client();
    }

    public function where($column)
    {
        return $this;
    }

    /**
     * @param $index
     * @param $type
     * @param $columns
     * @param $params
     * @param $from
     * @param $size
     *
     * @return array
     */
    public function search($index, $type, $columns, $params, $from, $size)
    {

        $searchParams['index'] = $index;
        $searchParams['type'] = $type;

        if (!$params) {
            $searchParams['body']['query']['match_all'] = [];
        } elseif (is_array($params)) {

        } else {
            $searchParams['body']['query']['match'][$columns] = $params;
        }

        $searchParams["from"] = $from;
        $searchParams["size"] = $size;

        $response = $this->elastic->search($searchParams);

        $count = $response['hits']['total'];
        $results = [];

        if (array_get($response, 'hits.hits')) {
            foreach (array_get($response, 'hits.hits') as $hit) {
                $results[] = array_get($hit, '_source');
            }
        }

        return [
            "total"        => (int)$count,
            "per_page"     => (int)$size,
            "current_page" => (int)$from,
            "last_page"    => (int)$from,
            "from"         => (int)$from,
            "to"           => (int)$size,
            'data'         => $results
        ];

    }

}