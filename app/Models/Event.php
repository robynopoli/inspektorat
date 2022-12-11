<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    const CHOICE_STATUS = ['diajukan', 'disetujui', 'ditolak'];
    const CHOICE_EVENT_PROBLEM = ['permasalahan hukum', 'permasalahan personal', 'permasalahan kepegawaian'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
