<?php

use App\Models\Reminder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->string('type')->nullable();
        });

        $reminders = Reminder::query()->get();
        foreach ($reminders as $reminder) {
            $type = '';
            if (! is_null($reminder->day)) {
                $type = 'day:'.$reminder->day;
            }
            if (! is_null($reminder->week)) {
                $type = 'week:'.$reminder->week;
            }
            if (! $type) {
                continue;
            }
            $reminder->type = $type;
            $reminder->save();
        }

        Schema::table('reminders', function (Blueprint $table) {
            $table->dropColumn(['day', 'week', 'once']);
        });
        Schema::table('reminders', function (Blueprint $table) {
            $table->string('type')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->integer('day')->nullable();
            $table->integer('week')->nullable();
            $table->boolean('once')->default(false);

            $table->dropColumn(['type']);
        });
    }
};
