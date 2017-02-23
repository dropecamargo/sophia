<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Validator ,Cache ,DB;

class Asignacion extends BaseModel
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

    /**
    * The attributes nulleables from the model.
    *
    * @var array
    */

    protected $nullable = ['asignacion1_municipio', 'asignacion1_zona','asignacion1_tecnico'];

    public function isValid($data)
    {
        $rules = [
            'asignacion1_fecha' => 'required',
            'asignacion1_tipo' => 'required|max:1',
            'asignacion1_direccion' => 'required_if:asignacion1_tipo,E|max:100',
            'asignacion1_area' => 'required_if:asignacion1_tipo,E|max:30',
            'asignacion1_centrocosto' => 'required_if:asignacion1_tipo,E|max:30',

        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            // Validar Carrito
            $asignacion2 = isset($data['asignacion2']) ? $data['asignacion2'] : null;
            if(!isset($asignacion2) || $asignacion2 == null || !is_array($asignacion2) || count($asignacion2) == 0) {
                $this->errors = 'Por favor ingrese toda la informacion para la asignacion.';
                return false;
            }

            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getAsignacion($id){
        $query = Asignacion::query();
        $query->select('asignacion1.*',DB::raw("CONCAT(tcontacto_nombres, ' ', tcontacto_apellidos) as contacto_nombre"),'tcontacto_telefono','t.tercero_nit','zona_nombre','municipio_nombre',DB::raw("CONCAT(t.tercero_nombre1, ' ', t.tercero_nombre2, ' ', t.tercero_apellido1, ' ', t.tercero_apellido2) as tercero_nombre"),'a.tercero_nit as tecnico_nit',DB::raw("CONCAT(a.tercero_nombre1, ' ', a.tercero_nombre2, ' ', a.tercero_apellido1, ' ', a.tercero_apellido2) as tecnico_nombre"));
        $query->join('tercero as t','asignacion1.asignacion1_tercero', '=', 't.id');
        $query->Leftjoin('tercero as a','asignacion1.asignacion1_tecnico', '=', 'a.id');
        $query->Leftjoin('municipio','asignacion1.asignacion1_municipio', '=', 'municipio.id');
        $query->Leftjoin('zona','asignacion1.asignacion1_zona', '=', 'zona.id');
        $query->join('tcontacto','asignacion1.asignacion1_contacto', '=', 'tcontacto.id');
        $query->where('asignacion1.id', $id);
        return $query->first();
    }
}
