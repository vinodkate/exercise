<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait ResponseFormat
{
    /** 
     * Paginator response
     */
    public function paginateData($paginator)
    {
        return [
            'current_page' => $paginator->currentPage(),
            'total' => $paginator->total(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'from' => $paginator->firstItem() ? : 0,
            'to' => $paginator->lastItem() ? : 0,
            'data' => $paginator->items()
        ];
    }
}
