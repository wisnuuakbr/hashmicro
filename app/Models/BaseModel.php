<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public function getFormattedTime()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

    abstract public function getDispplayName();
    // use HasFactory;
}
