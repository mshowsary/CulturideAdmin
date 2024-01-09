<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Carpooling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tickets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'seat',
        'codebar',
        'used',
        'customer_id',
        'zone_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id')->with(["event"]);
    }

    public function carpooling()
    {
        return $this->hasOne(Carpooling::class, 'ticket_id')->with(["city","carpoolingRequest"]);
    }
}
