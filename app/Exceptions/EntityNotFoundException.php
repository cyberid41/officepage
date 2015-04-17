<?php namespace App\Exceptions;

/**
 * Class EntityNotFoundException
 *
 * @package App\Exceptions
 */
class EntityNotFoundException
{
    /**
     * @param $id
     *
     * @return array
     */
    public function getByIdNotFound($id)
    {
        return [
            'success' => false,
            'message' => [
                'msg'      => 'Record tidak ada atau data telah dihapus',
                'identity' => $id
            ]
        ];
    }
}