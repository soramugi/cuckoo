<?php

namespace App\Console\Commands;

use App\Models\Reminder;
use App\Notifications\SendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class Send extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $now->second(0);
        Reminder::query()->chunkById(100, function ($reminders) use ($now) {
            foreach ($reminders as $reminder) {
                if ($now < $reminder->next_send) {
                    continue;
                }

                Notification::route('mail', $reminder->to)
                    ->notify(new SendMail($reminder));
                $reminder->compleded_at = $now;
                $reminder->save();
            }
        });
    }
}
