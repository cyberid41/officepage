<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request
 *
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function forbiddenResponse()
    {
        return [
            'success' => false,
            'result'  => [
                'message' => 'You are unauthorized',
                'action'  => 'redirect',
                'path'    => 'logout'
            ]
        ];
    }

}
