<?php namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 *
 * @package App\Repository
 */
abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getById($id)
    {
        return $this->getBy($this->model->getKeyName(), $id);
    }

    /**
     * @param $column
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBy($column, $value)
    {
        return $this->model->newQuery()->where($column, $value)->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function requireById($id)
    {
        $model = $this->getById($id);
        if (!$model) {
            return $this->notFound($id);
        }

        return $model;
    }

    /**
     * @param array $attributes
     *
     * @return static
     */
    public function getNewInstance($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * @param array $response
     *
     * @return mixed
     */
    public function successResponseOk(array $response = [])
    {
        return \Response::json($response, 200);
    }

    /**
     * @return mixed
     */
    public function successInsertResponse()
    {
        return $this->successResponseOk([
            'success' => true,
            'message' => [
                'msg' => 'Data berhasil disimpan',
            ],
        ]);
    }

    /**
     * @return mixed
     */
    public function successUpdateResponse()
    {
        return $this->successResponseOk([
            'success' => true,
            'message' => [
                'msg' => 'Data berhasil diupdate',
            ],
        ]);
    }

    /**
     * @return mixed
     */
    public function successDeleteResponse()
    {
        return $this->successResponseOk([
            'success' => true,
            'message' => [
                'msg' => 'Data berhasil dihapus',
            ],
        ]);
    }

    /**
     * @param $error
     *
     * @return mixed
     */
    public function errorResponse($error)
    {
        return $this->successResponseOk([
            'success' => false,
            'message' => [
                'msg'   => 'Internal server Error',
                'error' => $error
            ],
        ]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function notFound($id)
    {
        return $this->successResponseOk([
            'success' => false,
            'message' => [
                'msg'      => 'Data tidak ada atau sudah dihapus',
                'identity' => $id
            ],
        ]);
    }

}