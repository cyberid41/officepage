<?php namespace App\Http\Controllers\Api\V1;

use App\Eloquent\Contracts\CrudInterface;
use App\Http\Requests\DataPribadiFormRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;

/**
 * Class DataPribadiController
 *
 * @package App\Http\Controllers\Api\V1
 */
class DataPribadiController extends Controller
{
    /**
     * @var CrudInterface
     */
    protected $crud;

    /**
     * @param CrudInterface $crud
     */
    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @param IndexRequest $request
     *
     * @return mixed
     */
    public function index(IndexRequest $request)
    {
        return $this->crud->find($request->all());
    }

    /**
     * @param DataPribadiFormRequest $request
     *
     * @return mixed
     */
    public function store(DataPribadiFormRequest $request)
    {
        return $this->crud->create($request->all());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->crud->findById($id);
    }

    /**
     * @param                        $id
     * @param DataPribadiFormRequest $request
     *
     * @return mixed
     */
    public function update($id, DataPribadiFormRequest $request)
    {
        return $this->crud->update($id, $request->all());
    }

    /**
     * Destroy a record
     *
     * @param $id
     */
    public function destroy($id)
    {

    }

}

