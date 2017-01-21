<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Validator;

class ProductoMarca extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productomarca';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['productomarca_marca'];

    public function isValid($data)
    {
        $rules = [
            'productomarca_producto' => 'required|integer',
            'productomarca_marca' => 'required|integer',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public function setProductoMarcaAttribute($marca)
    {
        $this->attributes['productomarca_marca'] = strtoupper($marca);
    }
}
