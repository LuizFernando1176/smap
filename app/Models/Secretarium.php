<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Secretarium extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'secretarias';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'sigla', 'responsavel', 'telefone', 'email', 'logradouro', 'numero', 'bairro', 'latitude', 'longitude', 'idSecretariaPai'];

    public function secretarias()
    {
        return $this->belongsTo('App\Models\Secretaria');
    }

}
