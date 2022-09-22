<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebTraining extends Model
{
    protected $fillable = ['id', 'heading', 'status'];
    protected $table = 'web_trainings';
    use HasFactory;
    public function web_trainings_assets()
    {
        return $this->hasMany(WebTrainingAsset::class, 'web_tr_id', 'id');
    }
}
