<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classification;

class Instance extends Model
{

    protected $fillable = [
        'name', 'company_name', 'description', 'long_description'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function images(){
        return $this->hasMany('App\InstanceImage');
    }

    public function services(){
        return $this->hasMany('App\InstanceService');
    }

    public function getFeaturedImageAttribute()
    {
        $image = $this->images()->where('featured','=', '1')->get()->first()->image;
        if(substr($image, 0, 4) === "http")
            return $image;
        return 'providers/cases/'.$this->id.'/'.$this->images()->where('featured','=', '1')->get()->first()->image;
    }

    public function getFeaturedImageProvidersAttribute()
    {
        $image = $this->images()->where('featured','=', '1')->get()->first()->image;
        if(substr($image, 0, 4) === "http")
            return $image;
        return 'cases/'.$this->id.'/'.$this->images()->where('featured','=', '1')->get()->first()->image;
    }

    public function getClassificationAttribute()
    {
        return Classification::find($this->classification_id)->classification;
    }
}
