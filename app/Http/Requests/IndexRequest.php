<?php namespace App\Http\Requests;

use Illuminate\Validation\Validator;

class IndexRequest extends Request
{

    /**
     * Custom attribute
     *
     * @var array
     */
    protected $customAttributes = [
        'page'  => 'Halaman',
        'term'  => 'Keyword pencarian',
        'limit' => 'Limit',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'page'  => 'required|integer',
            'limit' => 'integer',
            'term'  => 'max:100'
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
                'page' => $message->first('page'),
                'term' => $message->first('term'),
            ]
        ];
    }
}
