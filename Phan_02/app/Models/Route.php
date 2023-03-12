<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function stations()
    {
        return $this->belongsToMany(Station::class)->withPivot('id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
