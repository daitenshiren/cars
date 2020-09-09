<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    //use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'make';

    /**
     *
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'make',
    ];

    /**
     * Get the model of the make.
     */
    public function carModels()
    {
        return $this->hasMany('App\Http\Models\CarModel');
    }
}
