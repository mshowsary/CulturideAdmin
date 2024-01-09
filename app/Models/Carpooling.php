<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpooling extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'carpoolings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'seat',
        'status',
        'codebar',
        'used',
        'city_id',
        'ticket_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'check_point_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function carpoolingRequest()
    {
        return $this->hasOne(CarpoolingRequest::class, 'carpooling_id');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id')->with(["zone"]);
    }
}
