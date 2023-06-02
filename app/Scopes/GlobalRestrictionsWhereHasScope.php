<?php

namespace App\Scopes;

use App\Traits\RestrictTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Gate;

class GlobalRestrictionsWhereHasScope implements Scope
{
    use RestrictTrait;

    protected $relation;

    public function __construct($relation)
    {
        $this->relation = $relation;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Gate::allows('is-admin')) {
            return $builder->whereHas($this->relation, function ($builder) {
                $builder->whereIn('company_id', $this->getCurrentUserCompaniesArray());
            });
        }
    }
}
