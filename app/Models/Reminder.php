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

        'type',

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
                $type = $attributes['type'];
                [$key, $value] = explode(':', $type);

                if ($key === 'week') {
                    $weeks = ['日', '月', '火', '水', '木', '金', '土'];

                    return '毎週'.$weeks[(int) $value].'曜日';
                }
                if ($key === 'day') {
                    return '毎月'.$value.'日';
                }

                return $type;
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

                $type = $attributes['type'];
                [$key, $value] = explode(':', $type);

                if ($key === 'week') {
                    $date->weekday((int) $value);
                    if ($date < $attributes['updated_at']) {
                        $date->addWeek();
                    }
                }
                if ($key === 'day') {
                    $date->day = (int) $value;
                    if ($date < $attributes['updated_at']) {
                        $date->addMonth();
                    }
                }

                return $date;
            },
        );
    }
}
