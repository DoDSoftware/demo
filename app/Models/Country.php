<?php

namespace App\Models;


use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var  string
     */
    protected $table = 'countries';

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
        'sort_name',
        'name',
        'phone_code',
     ];

    /**
     * Return the states that belong to this record
     *
     * @return HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
