<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    //use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     *
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'model',
        'make',
        'model',
        'year',
        'price',
    ];
}
