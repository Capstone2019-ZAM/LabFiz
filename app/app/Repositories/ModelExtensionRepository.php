<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ModelExtensionRepository.
 */
abstract class ModelExtensionRepository extends BaseRepository
{
    /**
     * Update or create model record in the database.
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = array())
    {
        $this->unsetClauses();

        return $this->model->updateOrCreate($attributes,$values);
    }
}
