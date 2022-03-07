<?php

namespace App\Scopes;

use App\Models\Company;
use App\Traits\RestrictTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Gate;

class GlobalRestrictionsWhereScope implements Scope
{
    use RestrictTrait;
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $model instanceof Company
            ? $condition = "id"
            : $condition = "company_id";

        if (Gate::allows('is-admin')) {
            return $builder->whereIn($condition, $this->getCurrentUserCompaniesArray());
        }
    }
}
