<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function event()
    {
        return $this->belongsTo(Events::class);
    }
    public function status()
    {
        return $this->belongsTo(
            CustomerStatus::class,
            'customer_status', // foreign key in customers table
            'value'            // referenced column in lookup.customer_status
        );
    }    
}
