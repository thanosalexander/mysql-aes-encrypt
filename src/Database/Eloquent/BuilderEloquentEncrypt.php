<?php

namespace mrzainulabideen\AESEncrypt\Database\Eloquent;

use mrzainulabideen\AESEncrypt\Database\Query\BuilderEncrypt as QueryBuilder;
use Illuminate\Database\Eloquent\Model;

class BuilderEloquentEncrypt extends \Illuminate\Database\Eloquent\Builder
{
    /**
     * Create a new Eloquent query builder instance.
     *
     * @param mrzainulabideen\AESEncrypt\Database\Query\BuilderEncrypt  $query
     * @return void
     */
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    /**
     * Set a model instance for the model being queried.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;

        $this->query->from($model->getTable());

        $this->query->setFillableEncrypt($model->getfillableEncrypt());

        return $this;
    }
}
