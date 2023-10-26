<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

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
                    if (! is_null($attributes['compleded_at']) && $date < $attributes['compleded_at']) {
                        $date->addWeek();
                    }
                }
                if (! is_null($attributes['day'])) {
                    $date->day = $attributes['day'];
                    if (! is_null($attributes['compleded_at']) && $date < $attributes['compleded_at']) {
                        $date->addMonth();
                    }
                }

                return $date;
            },
        );
    }
}
