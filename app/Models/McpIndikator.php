<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class McpIndikator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function area_intervensi() : BelongsTo
    {
        return $this->belongsTo(AreaIntervensi::class);
    }

    public function mcpSubIndikator() : HasMany
    {
        return $this->hasMany(McpSubIndikator::class);
    }
}
