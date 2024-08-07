<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Áp dụng bộ lọc vào query builder.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilters(Request $request, Builder $query, array $filters)
    {
        foreach ($filters as $field) {
            if ($request->filled($field)) {
                $query->where($field, 'ILIKE', '%' . $request->input($field) . '%');
            }
        }

        $searchKeyword = $request->input('search');

        if (!empty($searchKeyword)) {
            $query->where(function ($innerQuery) use ($searchKeyword, $filters) {
                foreach ($filters as $field) {
                    $innerQuery->orWhere($field, 'ILIKE', '%' . $searchKeyword . '%');
                }
            });
        }

        return $query;
    }
}
