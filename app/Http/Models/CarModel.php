<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    //use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model';

    /**
     *
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'model',
        'make_id',
    ];
}
