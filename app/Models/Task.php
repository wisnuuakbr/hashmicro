<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDispplayName()
    {
        return $this->title;
    }

    public function calculatePercentage($completedSubtask, $totalSubtask)
    {
        if ($totalSubtask == 0) return 0;
        return round(($completedSubtask / $totalSubtask) * 100);
    }
}
