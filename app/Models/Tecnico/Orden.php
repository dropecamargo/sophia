<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;

use Validator, DB;
use App\Models\BaseModel;

class Orden extends Model
{
	  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orden';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =['orden_fecha','orden_tipoorden','orden_solicitante','orden_persona','orden_dano','orden_prioridad','orden_problema'];

    public function isValid($data)
    {
        $rules = [  

        	'orden_fecha'=>'required|date_format:Y-m-d',
        	'orden_tipoorden'=>'required',
        	'orden_solicitante'=>'required',
        	'orden_tercero'=>'required',
        	'orden_dano'=>'required',
        	'orden_prioridad'=>'required',
        	'orden_problema'=>'required|max:100',
            'orden_fecha_servicio' => 'required|date_format:Y-m-d',
            'orden_hora_servicio' => 'required|date_format:H:m'


        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }


   public static function getOrden($id)
    {
        $query = Orden::query();
        $query->select('orden.*',DB::raw("TIME(orden_fh_servicio) as orden_hora_servicio"),DB::raw("DATE(orden_fh_servicio) as orden_fecha_servicio"), 'tercero_nit','producto.id as id_p','producto_nombre','producto_serie','dano_nombre','tipoorden_nombre','prioridad_nombre','solicitante_nombre', DB::raw("CONCAT(tercero_nombre1, ' ', tercero_nombre2, ' ', tercero_apellido1, ' ', tercero_apellido2) as tercero_nombre"));
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

