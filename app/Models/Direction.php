<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',
        'sphere_id'
    ];
}
