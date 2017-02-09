<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator, Cache,DB;

class Visita extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visita';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['visita_orden','visita_tecnico','visita_tiempo_transporte','visita_viaticos'];

    public function isValid($data)
    {
        $rules = [
            'visita_fecha_llegada' => 'required|date_format:Y-m-d',
            'visita_hora_llegada' => 'required|date_format:H:s',
            'visita_fecha_inicio' => 'required|date_format:Y-m-d',
            'visita_hora_inicio' => 'required|date_format:H:s',
            'visita_fecha_fin' => 'required|date_format:Y-m-d',
            'visita_hora_fin' => 'required|date_format:H:s',
            'visita_tiempo_transporte' => 'required',
            'visita_viaticos' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            // Validar Carrito
            $detalle = isset($data['visitap']) ? $data['visitap'] : null;
            if(!isset($detalle) || $detalle == null || !is_array($detalle) || count($detalle) == 0) {
                $this->errors = 'Por favor ingrese detalles de la visita';
                return false;
            }

            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }


    public static function getVisita($id)
    {
        $query = Visita::query();
        return $query->first();
    }
}
