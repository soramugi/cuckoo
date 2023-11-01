<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\Jetstream;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',

        'time',
        'to',

        'day',
        'week',

        'once',

        'compleded_at',
        'team_id',
    ];

    protected $casts = [
        'compleded_at' => 'datetime',
    ];

    /**
     * Get the team that the invitation belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Jetstream::teamModel());
    }

    protected function repeatText(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (! is_null($attributes['week'])) {
                    $weeks = ['日', '月', '火', '水', '木', '金', '土'];

                    return '毎週'.$weeks[$attributes['week']].'曜日';
                }
                if (! is_null($attributes['day'])) {
                    return '毎月'.$attributes['day'].'日';
                }

                return $attributes['day'];
            },
        );
    }

    protected function nextSend(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                [$hour, $min] = explode(':', $attributes['time']);

                $date = now();
                $date->hour = $hour;
                $date->minute = $min;
                if (! is_null($attributes['week'])) {
                    $date->weekday($attributes['week']);
                    if ($date < $attributes['updated_at']) {
                        $date->addWeek();
                    }
                }
                if (! is_null($attributes['day'])) {
                    $date->day = $attributes['day'];
                    if ($date < $attributes['updated_at']) {
                        $date->addMonth();
                    }
                }

                return $date;
            },
        );
    }
}
