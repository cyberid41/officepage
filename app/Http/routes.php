<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('get-token', function () {
    echo csrf_token();
});

Route::get('data-pribadi', 'Api\V1\DataPribadiController@index');
Route::get('data-pribadi/{id}', 'Api\V1\DataPribadiController@show');
Route::get('data-pribadi/{keluarga_id}/keluarga', 'Api\V1\DataPribadiController@findByKeluargaId');
Route::post('data-pribadi', 'Api\V1\DataPribadiController@store');
Route::put('data-pribadi/{id}', 'Api\V1\DataPribadiController@update');
Route::delete('data-pribadi/{id}', 'Api\V1\DataPribadiController@destroy');

Route::get('elasticsearch-post', function () {
    $client = new Elasticsearch\Client();

    $params = [];
    $params['body'] = [
        'nama'      => 'Singgih AS',
        'pekerjaan' => 'Frontend Developer',
        'kota'      => 'Jombang',
    ];
    $params['index'] = 'app_index';
    $params['type'] = 'data_pribadi';
    $params['id'] = '5';
    $ret = $client->index($params);

    return $ret;
});

Route::get('elasticsearch-get', function () {
    $client = new Elasticsearch\Client();
    $searchParams['index'] = 'app_index';
    $searchParams['type'] = 'data_pribadi';
    $searchParams['body']['query']['match_all'] = [];
    $searchParams["from"] = 0;
    $searchParams["size"] = 15;

    $response = $client->search($searchParams);

    $results = [];

    if (array_get($response, 'hits.hits')) {
        foreach (array_get($response, 'hits.hits') as $hit) {
            $results[] = array_get($hit, '_source');
        }
    }

    return [
        'to'    => 10,
        'from'  => 1,
        'last'  => 10,
        'total' => 100,
        'data'  => $results
    ];

});

Route::get('elasticsearch-delete', function () {
    $client = new Elasticsearch\Client();

    $deleteParams['index'] = 'app_index';
    $client->indices()->delete($deleteParams);
});

Route::get('cek-class', function () {
    $class = new \App\Services\Elasticsearch\Query();

    $term = \Illuminate\Support\Facades\Input::get('term');

    return $class->index('app_index')
        ->type('data_pribadi')
        ->where('kota', $term)
        ->get();
});
