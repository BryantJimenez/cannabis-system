<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
	use SoftDeletes;

    protected $fillable = ['type', 'plants_count', 'flower', 'larf', 'trim', 'waste', 'note', 'state', 'strain_id', 'room_id', 'harvest_id', 'container_id', 'user_id'];

    /**
     * Get the type.
     *
     * @return string
     */
    public function getTypeAttribute($value)
    {
        if ($value=='1') {
            return 'Curado';
        } elseif ($value=='2') {
            return 'Trimmiado';
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
        $stage=$this->with(['user' => function($query) {
            $query->withTrashed();
        }, 'strain' => function($query) {
            $query->withTrashed();
        }, 'room' => function($query) {
            $query->withTrashed();
        }, 'harvest' => function($query) {
            $query->withTrashed();
        }, 'container' => function($query) {
            $query->withTrashed();
        }, 'plants'])->where($field, $value)->first();
        if (!is_null($stage)) {
            return $stage;
        }

        return abort(404);
    }

    public function strain() {
        return $this->belongsTo(Strain::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function harvest() {
        return $this->belongsTo(Harvest::class);
    }

    public function container() {
        return $this->belongsTo(Container::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function plants() {
        return $this->belongsToMany(Plant::class)->withTimestamps();
    }
}
