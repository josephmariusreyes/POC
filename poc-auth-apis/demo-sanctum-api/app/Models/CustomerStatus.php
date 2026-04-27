<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomerStatus extends Model
{
    protected $table = 'lookup.customer_status';

    public function customers()
    {
        return $this->hasMany(
            Customer::class,
            'customer_status', // FK in customers table
            'value'            // column in this table
        );
    }
}