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
    protected $fillable = ['visita_orden', 'visita_tecnico','visita_tiempo_transporte','visita_viaticos'];

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
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }


    public static function getVisita($id)
    {
        $query = Orden::query();
        $query->select('orden.*',DB::raw("TIME(orden_fh_servicio) as orden_hora_servicio"),DB::raw("DATE(orden_fh_servicio) as orden_fecha_servicio"), 'tercero_nit','producto_nombre','producto_serie','dano_nombre','tipoorden_nombre','prioridad_nombre','solicitante_nombre', DB::raw("CONCAT(tercero_nombre1, ' ', tercero_nombre2, ' ', tercero_apellido1, ' ', tercero_apellido2) as tercero_nombre"));
        $query->join('tercero', 'orden.orden_tercero', '=', 'tercero.id');
        $query->join('dano', 'orden.orden_dano', '=', 'dano.id');
        $query->join('tipoorden', 'orden.orden_tipoorden', '=', 'tipoorden.id');
        $query->join('solicitante', 'orden.orden_solicitante', '=', 'solicitante.id');
        $query->join('prioridad', 'orden.orden_prioridad', '=', 'prioridad.id');
        $query->join('producto', 'orden.orden_placa', '=', 'producto.id');

        $query->where('orden.id', $id);
        return $query->first();
    }
}
