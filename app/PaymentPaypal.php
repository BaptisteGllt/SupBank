<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPaypal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'reference', 'bill','bill_number','amount_sc',
    ];
}
