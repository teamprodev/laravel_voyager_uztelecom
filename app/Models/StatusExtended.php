<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;

/**
 * @method static Builder find($id, $columns = ['*'])
 * @method static Builder pluck($column, $key = null)
 */
class StatusExtended extends ALL
{
    protected $table = 'status_extended';
}
