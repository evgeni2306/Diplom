<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',
        'direction_id'
    ];

    static function getProfByDirectionId(int $directionId): Collection
    {
        return self::query()->where('direction_id', $directionId)->select('id', 'name')->get();
    }

    static function getProfById(int $profId): Collection
    {
        return self::query()->where('id', $profId)->select('id', 'name')->get();
    }

    static function getProfIdByName(string $profName): int
    {
        return self::query()->where('name', '=', $profName)->first()->id;

    }

}
