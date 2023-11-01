<?php

use App\Models\Reminder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->foreignId('team_id')->nullable();
        });

        $team = DB::table('teams')->first();
        Reminder::query()->update(['team_id' => $team->id]);

        Schema::table('reminders', function (Blueprint $table) {
            $table->foreignId('team_id')->index()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'team_id',
            ]));
        });
    }
};
