<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class McpSubIndikator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mcp_indikator()
    {
        return $this->belongsTo(McpIndikator::class);
    }

    public function obrik()
    {
        return $this->belongsTo(Obrik::class);
    }

    public function mcp_document() : HasMany
    {
        return $this->hasMany(McpDocument::class);
    }
}
