<?php namespace App\Repository;

use App\Exceptions\EntityNotFoundException;
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
     * @var EntityNotFoundException
     */
    protected $exception;

    /**
     * @param Model                   $model
     * @param EntityNotFoundException $exception
     */
    public function __construct(Model $model, EntityNotFoundException $exception)
    {
        $this->model = $model;
        $this->exception = $exception;
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
            return $this->exception->getByIdNotFound($id);
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

}