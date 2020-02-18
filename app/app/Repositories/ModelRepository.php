<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class ModelRepository.
 */
class ModelRepository extends ModelExtensionRepository
{
    protected $model;

    /**
     * ModelRepository constructor.
     * dependancy injection for eloquent models
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return $this->model;
    }
}
