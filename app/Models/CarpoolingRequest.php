<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarpoolingRequest extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'carpooling_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'accepted',
        'seat',
        'carpooling_id',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function carpooling()
    {
        return $this->belongsTo(Carpooling::class, 'carpooling_id');
    }
    public function parent()
    {
        return $this->belongsTo(Carpooling::class, 'parent_id')->with(['ticket']);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
