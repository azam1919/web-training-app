<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'a_id', 'u_id', 'r_id', 'status'];
    protected $table = 'alerts';
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'u_id');
    }
}
