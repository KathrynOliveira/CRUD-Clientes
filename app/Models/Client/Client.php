<?php

namespace App\Models\Client;

use App\Models\Address\Address;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'cpf',
        'birthdate',
        'email',
        'status'
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => now()->diffInYears(Carbon::parse($this->attributes["birthdate"]))
        );
    }

    protected function formattedDate(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Carbon::parse($this->birthdate)->format('d/m/Y');
            }
        );
    }
}
