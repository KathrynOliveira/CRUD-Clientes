<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'client_id',
        'zip_code',
        'street',
        'house_number',
        'city',
        'state'
    ];
}
