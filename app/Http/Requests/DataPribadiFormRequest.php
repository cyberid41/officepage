<?php namespace App\Http\Requests;

use Illuminate\Validation\Validator;

class DataPribadiFormRequest extends Request
{

    /**
     * Custom attribute
     *
     * @var array
     */
    protected $customAttributes = [
        'nik'               => 'Nomor Induk Keluarga',
        'gelar_depan'       => 'Gelar Depan',
        'nama_lengkap'      => 'Nama Lengkap',
        'gelar_belakang'    => 'Gelar Belakang',
        'jenis_kelamin'     => 'Jenis Kelamin',
        'tempat_lahir'      => 'Tempat lahir',
        'tanggal_lahir'     => 'Tanggal lahir',
        'status_perkawinan' => 'Status perkawinan',
        'hub_keluarga'      => 'Hubungan keluarga',
        'agama'             => 'Agama',
        'golongan_darah'    => 'Golongan darah',
        'pendidikan'        => 'Pendidikan',
        'pekerjaan'         => 'Pekerjaan',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'nik'               => 'required|max:30',
            'gelar_depan'       => 'max:50',
            'nama_lengkap'      => 'required|max:255',
            'gelar_belakang'    => 'max:50',
            'jenis_kelamin'     => 'required|max:20',
            'tempat_lahir'      => 'required|max:50',
            'tanggal_lahir'     => 'required|max:20',
            'status_perkawinan' => 'required|max:20',
            'hub_keluarga'      => 'required|max:20',
            'agama'             => 'required|max:20',
            'golongan_darah'    => 'max:10',
            'pendidikan'        => 'required|max:100',
            'pekerjaan'         => 'required|max:100',
        ];
    }

    /**
     * @param $validator
     *
     * @return mixed
     */
    public function validator($validator)
    {
        return $validator->make($this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->customAttributes);
    }

    /**
     * @param Validator $validator
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $message = $validator->errors();

        return [
            'success'    => false,
            'validation' => [
                'nik'               => $message->first('nik'),
                'gelar_depan'       => $message->first('gelar_depan'),
                'nama_lengkap'      => $message->first('nama_lengkap'),
                'gelar_belakang'    => $message->first('gelar_belakang'),
                'jenis_kelamin'     => $message->first('jenis_kelamin'),
                'tempat_lahir'      => $message->first('tempat_lahir'),
                'tanggal_lahir'     => $message->first('tanggal_lahir'),
                'status_perkawinan' => $message->first('status_perkawinan'),
                'hub_keluarga'      => $message->first('hub_keluarga'),
                'agama'             => $message->first('agama'),
                'golongan_darah'    => $message->first('golongan_darah'),
                'pendidikan'        => $message->first('pendidikan'),
                'pekerjaan'         => $message->first('pekerjaan'),
            ]
        ];
    }
}
