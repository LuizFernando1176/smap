<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atividade extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'atividades';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'percentual', 'prazo', 'status', 'responsavel', 'observacao', 'numeroPPA', 'pPA', 'idAcao', 'idSecretaria'];

    public function acaos()
    {
        return $this->belongsTo('App\Models\Acao');
    }

}
