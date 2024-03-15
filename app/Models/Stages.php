<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stages extends Model
{
    use HasFactory;

    protected $table = 'stages'; // Specify the table name if it's different from the model name

    protected $fillable = ['stage']; // Specify the columns that can be mass-assigned
    public $timestamps = false;

    // You can add relationships or other model-specific logic here
}
