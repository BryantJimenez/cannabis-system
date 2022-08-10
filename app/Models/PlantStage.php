<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantStage extends Model
{
    protected $table = 'plant_stage';

    protected $fillable = ['plant_id', 'stage_id'];
}
