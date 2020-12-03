<?php

namespace redsd\AESEncrypt\Database\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use redsd\AESEncrypt\Database\Query\BuilderEncrypt as QueryBuilder;

abstract class ModelEncrypt extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillableEncrypt = [];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();

        $this->initializeTraits();

        $this->syncOriginal();

        $this->fill($attributes);

        $this->setSessionVariables();
    }

    public function setSessionVariables()
    {
        static $mysql_session_set;
        if (!isset($mysql_session_set)) {
            $key = env('APP_AESENCRYPT_KEY');
            DB::statement(sprintf("SET @AESKEY = '%s'", $key));
            $mysql_session_set = true;
        }
    }


    /**
     * Get a new query builder that doesn't have any global scopes.
     *
     * @return \redsd\AESEncrypt\Database\Eloquent\BuilderEloquentEncrypt|static
     */
    public function newQueryWithoutScopes()
    {
        $builder = $this->newEloquentBuilder($this->newBaseQueryBuilder());


        // Once we have the query builders, we will set the model instances so the
        // builder can easily access any information it may need from the model
        // while it is constructing and executing various queries against it.

        return $builder->setModel($this)
                    //->setfillableColumns($this->fillable)
                    ->with($this->with)
                    ->withCount($this->withCount);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \redsd\AESEncrypt\Database\Query\BuilderEncrypt   $query
     * @return \redsd\AESEncrypt\Database\Eloquent\BuilderEloquentEncrypt|static
     */
    public function newEloquentBuilder($query)
    {
        return new BuilderEloquentEncrypt($query);
    }

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \redsd\AESEncrypt\Database\Query\BuilderEncrypt
     */
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new QueryBuilder(
            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
        );
    }

    // /**
    //  * Get the table associated with the model.
    //  *
    //  * @return string
    //  */
    public function getfillableEncrypt()
    {
        return $this->fillableEncrypt;
    }
}
