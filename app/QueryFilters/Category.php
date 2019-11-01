<?php


namespace App\QueryFilters;

class Category extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('category_id', request($this->filterName()));
    }
}