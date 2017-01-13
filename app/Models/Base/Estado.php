<?php

namespace App\Models\Base;
use Validator;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Estado extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estado';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['estado_nombre'];

    protected $boolean = ['estado_activo'];

    public function isValid($data)
    {
        $rules = [
            'estado_nombre' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
