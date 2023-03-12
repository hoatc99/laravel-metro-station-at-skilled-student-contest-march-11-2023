<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $table = 'stations';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function routes()
    {
        return $this->belongsToMany(Route::class)->withPivot('id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
