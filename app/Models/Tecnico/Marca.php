<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marca';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['marca_modelo','marca_activo'];
}
