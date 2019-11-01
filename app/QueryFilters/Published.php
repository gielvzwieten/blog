<?php

namespace App\QueryFilters;

class Published extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('created_at', request($this->filterName()));
    }
}