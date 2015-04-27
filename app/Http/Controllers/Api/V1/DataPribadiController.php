<?php namespace App\Http\Controllers\Api\V1;

use App\Eloquent\Contracts\AbstractCrud;
use App\Eloquent\Repositories\DataPribadiRepository;
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
     * Create a new instance Controller
     *
     * @param AbstractCrud $crud
     */
    public function __construct(AbstractCrud $crud)
    {
        $this->dataPribadi = $crud->setCrud(new DataPribadiRepository());
    }

    /**
     * @param IndexRequest $request
     *
     * @return mixed
     */
    public function index(IndexRequest $request)
    {
        return $this->dataPribadi->find($request->all());
    }

    /**
     * @param DataPribadiFormRequest $request
     *
     * @return mixed
     */
    public function store(DataPribadiFormRequest $request)
    {
        return $this->dataPribadi->create($request->all());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->dataPribadi->findById($id);
    }

    /**
     * @param                        $id
     * @param DataPribadiFormRequest $request
     *
     * @return mixed
     */
    public function update($id, DataPribadiFormRequest $request)
    {
        return $this->dataPribadi->update($id, $request->all());
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

