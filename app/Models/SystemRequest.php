<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'request_details',
        'request_status'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(SystemRequestCategory::class);
    }
}
