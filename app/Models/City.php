<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var  string
     */
    protected $table = 'cities';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var  array
     */
    protected $fillable = [
         'name',
         'state_id',
     ];

    /**
     * Return the state that this record belongs to
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
