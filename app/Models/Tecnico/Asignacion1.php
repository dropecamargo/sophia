<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator ,Cache ,DB;

class Asignacion1 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asignacion1';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asignacion1_fecha','asignacion1_tipo','asignacion1_direccion','asignacion1_area','asignacion1_centrocosto','asignacion1_municipio','asignacion1_zona'];


    public function isValid($data)
    {
        $rules = [
            'asignacion1_fecha' => 'required',
            'asignacion1_tipo' => 'required|max:1',
            'asignacion1_direccion' => 'required|max:100',
            'asignacion1_area' => 'required|max:30',
            'asignacion1_centrocosto' => 'required|max:30',

        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getAsignacion($id){
        $query = Asignacion1::query();
        $query->select('asignacion1.*',DB::raw("CONCAT(tcontacto_nombres, ' ', tcontacto_apellidos) as contacto_nombre"),'tcontacto_telefono','t.tercero_nit','zona_nombre','municipio_nombre',DB::raw("CONCAT(t.tercero_nombre1, ' ', t.tercero_nombre2, ' ', t.tercero_apellido1, ' ', t.tercero_apellido2) as tercero_nombre"),'a.tercero_nit as tecnico_nit',DB::raw("CONCAT(a.tercero_nombre1, ' ', a.tercero_nombre2, ' ', a.tercero_apellido1, ' ', a.tercero_apellido2) as tecnico_nombre"));
        $query->join('tercero as t','asignacion1.asignacion1_tercero', '=', 't.id');
        $query->join('tercero as a','asignacion1.asignacion1_tecnico', '=', 'a.id');
        $query->join('municipio','asignacion1.asignacion1_municipio', '=', 'municipio.id');
        $query->join('zona','asignacion1.asignacion1_zona', '=', 'zona.id');
        $query->join('tcontacto','asignacion1.asignacion1_contacto', '=', 'tcontacto.id');
        $query->where('asignacion1.id', $id);
        return $query->first();
    }
}
