<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    protected $fillable = ['module', 'description', 'note', 'action', 'user_id'];

    /**
     * Get the action.
     *
     * @return string
     */
    public function getActionAttribute($value)
    {
        if ($value=='1') {
            return 'Crear';
        } elseif ($value=='2') {
            return 'Editar';
        } elseif ($value=='3') {
            return 'Eliminar';
        } elseif ($value=='4') {
            return 'Vaciar';
        }
        return 'Desconocido';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $log=$this->with(['user' => function($query) {
            $query->withTrashed();
        }])->where($field, $value)->first();
        if (!is_null($log)) {
            return $log;
        }

        return abort(404);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
