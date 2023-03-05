<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',

    ];
    static function getIdByName(string $name):Model
    {
        return self::query()->where('name','=',$name)->select('id')->first();
    }
}
