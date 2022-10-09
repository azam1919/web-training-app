<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebTrainingAsset extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'image', 'latitude', 'longitude', 'height', 'width', 'web_tr_id'];
    protected $table = 'web_trainings_assets';
    use HasFactory;
    public function web_trainings()
    {
        return $this->hasOne(WebTraining::class, 'web_tr_id', 'id');
    }
}
