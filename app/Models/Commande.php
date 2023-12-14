<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Str;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = ['status'];
    protected $with = [];

    public function conseiller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'conseiller_id');
    }

    public function infographiste(): BelongsTo
    {
        return $this->belongsTo(User::class, 'infographiste_id');
    }

    public function lignes(): HasMany
    {
        return $this->hasMany(Ligne::class);
    }

    public function getMontantAttribute(): int
    {
        return $this->lignes()->sum(new Expression('quantite * pu'));
    }

    public function getPkAttribute(): string
    {
        return Str::of($this->id)->padLeft(5, '0');
    }

    public function getStateAttribut()
    {
        $lignes = $this->lignes()->get();

    }

    protected static function booted()
    {
        parent::addGlobalScope('actif', function(Builder $query){
            return $query->whereNull('deleted_at');
        });
    }

    public function getPercentAttribute()
    {
        return $this->lignes()->count() != 0 ?
            $this->lignes()->whereStatus('termine')->count() / $this->lignes()->count() *100 :
            0
            ;
    }


}
