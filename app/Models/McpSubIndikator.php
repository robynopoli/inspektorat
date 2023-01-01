<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class McpSubIndikator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mcpDocument() : HasMany
    {
        return $this->hasMany(McpSubIndikator::class);
    }
}
