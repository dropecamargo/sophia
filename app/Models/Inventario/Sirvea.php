<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

use Validator;

class Sirvea extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sirvea';

    public $timestamps = false;

    public function isValid($data)
    {
        $rules = [
            'sirvea_codigo' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
