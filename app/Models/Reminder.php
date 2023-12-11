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

        'type', // TODO: 定数化する

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

                if ($key === 'day') {
                    return '毎日';
                }

                if ($key === 'week') {
                    $weeks = ['日', '月', '火', '水', '木', '金', '土'];
                    $nums = explode(',', $value);

                    $array = [];
                    foreach ($nums as $num) {
                        $array[] = $weeks[(int) $num];
                    }

                    return '毎週'.implode(',', $array).'曜日';
                }
                if ($key === 'month') {
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

                if ($key === 'day') {
                    if ($date < $attributes['updated_at']) {
                        $date->addDay();
                    }
                }
                if ($key === 'week') {
                    $nums = explode(',', $value);
                    $array = [];
                    foreach ($nums as $num) {
                        $copyDate = $date->clone();
                        $copyDate->weekday((int) $num);
                        if ($copyDate < $attributes['updated_at']) {
                            $copyDate->addWeek();
                        }
                        $array[] = $copyDate;
                    }
                    $date = collect($array)->min();
                }
                if ($key === 'month') {
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
