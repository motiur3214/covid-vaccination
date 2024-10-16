<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $vaccination_center_id
 * @property string $schedule_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\VaccinationCenter|null $vaccine_center
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereScheduleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccineSchedule whereVaccinationCenterId($value)
 * @mixin \Eloquent
 */
class VaccineSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccination_center_id',
        'schedule_date',
    ];

    /**
     * @return BelongsTo
     */
    public function vaccine_center(): BelongsTo
    {

        return $this->belongsTo(VaccinationCenter::class);
    }

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }
}
