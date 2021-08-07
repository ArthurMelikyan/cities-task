<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityWeather extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['time'];

    public function getTimeAttribute(){
        return $this->updated_at->format('Y-m-d h:i');
    }
}
