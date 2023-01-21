<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class McpDocument extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mcp_tindak_lanjut() : HasMany
    {
        return $this->hasMany(McpTindakLanjut::class);
    }

    public function mcp_sub_indikator(): BelongsTo
    {
        return $this->belongsTo(McpSubIndikator::class);
    }

}
