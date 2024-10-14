<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter query()
 * @property int $id
 * @property string $name
 * @property int $daily_limit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter whereDailyLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationCenter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VaccinationCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'daily_limit',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
