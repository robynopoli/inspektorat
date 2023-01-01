<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaIntervensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mcpIndikator() : HasMany
    {
        return $this->hasMany(McpIndikator::class);
    }
}
