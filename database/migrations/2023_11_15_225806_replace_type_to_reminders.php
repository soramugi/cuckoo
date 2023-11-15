<?php

use App\Models\Reminder;
use Illuminate\Database\Migrations\Migration;

/**
 * typeに設定した 'day' 識別子を 'month' に変換
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $reminders = Reminder::query()->get();
        foreach ($reminders as $reminder) {
            [$type_mode, $type_value] = explode(':', $reminder->type);
            if ($type_mode === 'day') {
                $reminder->type = 'month:'.$type_value;
                $reminder->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $reminders = Reminder::query()->get();
        foreach ($reminders as $reminder) {
            [$type_mode, $type_value] = explode(':', $reminder->type);
            if ($type_mode === 'month') {
                $reminder->type = 'day:'.$type_value;
                $reminder->save();
            }
        }
    }
};
