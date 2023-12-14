<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ligne extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['commande'];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    protected static function booted()
    {
        parent::addGlobalScope('actif', function(Builder $query){
            return $query->whereNull('deleted_at');
        });
    }
}
