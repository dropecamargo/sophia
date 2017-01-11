<?php

namespace App\Models\Base;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Validator, DB;

class Tercero extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tercero';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getName()
    {
        return $this->attributes['tercero_razonsocial'] ? $this->attributes['tercero_razonsocial'] : sprintf('%s %s %s', $this->attributes['tercero_nombre1'], $this->attributes['tercero_apellido1'], $this->attributes['tercero_apellido2']);
    }

    public function setTerceroNombre1Attribute($name)
    {
        $this->attributes['tercero_nombre1'] = strtoupper($name);
    }

    public function setTerceroNombre2Attribute($name)
    {
        $this->attributes['tercero_nombre2'] = strtoupper($name);
    }

    public function setTerceroApellido1Attribute($lastname)
    {
        $this->attributes['tercero_apellido1'] = strtoupper($lastname);
    }

    public function setTerceroApellido2Attribute($lastname)
    {
        $this->attributes['tercero_apellido2'] = strtoupper($lastname);
    }

    public function setTerceroRazonsocialAttribute($name)
    {
        $this->attributes['tercero_razonsocial'] = strtoupper($name);
    }

    public function setTerceroDireccionAttribute($name)
    {
        $this->attributes['tercero_direccion'] = strtoupper($name);
    }
}
