<?php namespace App\Eloquent\Repositories;

use App\Eloquent\AbstractRepository;
use App\Eloquent\Contracts\CrudInterface;
use App\Entities\DataPribadi;
use App\Services\Elasticsearch\Query as Elasticsearch;
use App\Services\LaraCacheInterface;

/**
 * Class DataPribadiRepository
 *
 * @package App\Repository
 */
class DataPribadiRepository extends AbstractRepository implements CrudInterface
{
    /**
     * Index of Elasticsearch
     *
     * @var string
     */
    private $index = "app_index";

    /**
     * Type of Elasticsearch
     *
     * @var string
     */
    private $type = "data_pribadi";

    /**
     * @param DataPribadi        $dataPribadi
     * @param LaraCacheInterface $cache
     * @param Elasticsearch      $elastic
     */
    public function __construct(DataPribadi $dataPribadi, LaraCacheInterface $cache, Elasticsearch $elastic)
    {
        $this->cache = $cache;
        $this->model = $dataPribadi;
        $this->elastic = $elastic;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function find(array $data)
    {
        return $this->elastic->index($this->index)
            ->type($this->type)
            ->where('kota', $data['term'])
            ->limit($data['page'], $data['limit'])
            ->get();
    }

    /**
     * Create data
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        try {

            $dataPribadi = $this->getNewInstance();
            $dataPribadi->nik = e($data['nik']);
            $dataPribadi->gelar_depan = allow_null($data['gelar_depan']);
            $dataPribadi->nama_lengkap = e($data['nama_lengkap']);
            $dataPribadi->gelar_belakang = allow_null($data['gelar_belakang']);
            $dataPribadi->jenis_kelamin = e($data['jenis_kelamin']);
            $dataPribadi->tempat_lahir = e($data['tempat_lahir']);
            $dataPribadi->tanggal_lahir = e($data['tanggal_lahir']);
            $dataPribadi->status_perkawinan = e($data['status_perkawinan']);
            $dataPribadi->hub_keluarga = e($data['hub_keluarga']);
            $dataPribadi->agama = e($data['agama']);
            $dataPribadi->golongan_darah = allow_null($data['golongan_darah']);
            $dataPribadi->pendidikan = e($data['pendidikan']);
            $dataPribadi->pekerjaan = e($data['pekerjaan']);
            $dataPribadi->save();

            return $this->successInsertResponse();

        } catch (\Exception $ex) {
            \Log::error('DataPribadiRepository create action something wrong -' . $ex);

            return $this->errorResponse($ex);
        }
    }

    /**
     * Show the Record
     *
     * @param $id
     *
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return $this->getById($id);
    }

    /**
     * Update the record
     *
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data)
    {
        try {
            $dataPribadi = $this->requireById($id);

            $dataPribadi->nik = e($data['nik']);
            $dataPribadi->gelar_depan = allow_null($data['gelar_depan']);
            $dataPribadi->nama_lengkap = e($data['nama_lengkap']);
            $dataPribadi->gelar_belakang = allow_null($data['gelar_belakang']);
            $dataPribadi->jenis_kelamin = e($data['jenis_kelamin']);
            $dataPribadi->tempat_lahir = e($data['tempat_lahir']);
            $dataPribadi->tanggal_lahir = e($data['tanggal_lahir']);
            $dataPribadi->status_perkawinan = e($data['status_perkawinan']);
            $dataPribadi->hub_keluarga = e($data['hub_keluarga']);
            $dataPribadi->agama = e($data['agama']);
            $dataPribadi->golongan_darah = allow_null($data['golongan_darah']);
            $dataPribadi->pendidikan = e($data['pendidikan']);
            $dataPribadi->pekerjaan = e($data['pekerjaan']);
            $dataPribadi->save();

            return $this->successUpdateResponse();

        } catch (\Exception $ex) {
            \Log::error('DataPribadiRepository update action something wrong -' . $ex);

            return $this->errorResponse($ex);
        }
    }

    /**
     * Destroy the record
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        try {

            /*Return result success*/
            return $this->successDeleteResponse();

        } catch (\Exception $ex) {
            \Log::error('DataPribadiRepository destroy action something wrong -' . $ex);

            return $this->errorResponse($ex);
        }
    }

    /**
     * @param $keluarga_id
     *
     * @return mixed
     */
    public function findByKeluargaId($keluarga_id)
    {
        return 'okey';
    }

}
