<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AdminEmailNotifier;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TestReminderEmail extends Command
{
    protected $signature   = 'reminders:test {email}';
    protected $description = 'Send a test reminder email to a specific address';

    public function handle(): void
    {
        $email = $this->argument('email');
        $user  = User::where('email', $email)->first();
        $name  = $user ? $user->name : 'User';

        $s = \DB::table('app_settings')->pluck('value', 'key');
        $smtpHost     = $s['smtp_host']     ?? config('mail.mailers.smtp.host');
        $smtpPort     = $s['smtp_port']     ?? config('mail.mailers.smtp.port', '587');
        $smtpUser     = $s['smtp_username'] ?? config('mail.from.address');
        $smtpPass     = $s['smtp_password'] ?? config('mail.mailers.smtp.password');
        $smtpFromName = $s['smtp_from_name'] ?? config('app.name');

        if (empty($smtpHost) || empty($smtpUser) || empty($smtpPass)) {
            $this->error('SMTP not configured.');
            return;
        }

        config([
            'mail.mailers.smtp.host'       => $smtpHost,
            'mail.mailers.smtp.port'       => $smtpPort,
            'mail.mailers.smtp.username'   => $smtpUser,
            'mail.mailers.smtp.password'   => $smtpPass,
            'mail.mailers.smtp.encryption' => 'tls',
            'mail.from.address'            => $smtpUser,
            'mail.from.name'               => $smtpFromName,
            'mail.default'                 => 'smtp',
        ]);

        $tomorrow = Carbon::tomorrow()->format('F j, Y');
        $body = "<b>💰 Commission Release Tomorrow</b><br>Juan dela Cruz — Sunshine Residences | Agent: Maria Santos | ₱25,000.00<br><br>"
              . "<b>🏠 Site Visit Tomorrow</b><br>Pedro Reyes — Lot 12 Block 5, Sunrise Village | Agent: Jose Rizal | 10:00 AM<br><br>"
              . "<b>📋 Downpayment Due Tomorrow</b><br>Ana Gonzales — Palm Grove Estates | Agent: Maria Santos<br><br>";

        $html = AdminEmailNotifier::buildPublicHtml("Tomorrow's Events — {$tomorrow}", $body, $name);

        try {
            Mail::html($html, fn($msg) => $msg->to($email)->subject("ArkCrest Test: Reminder Email — {$tomorrow}")->from($smtpUser, $smtpFromName));
            $this->info("Test email sent to {$email}!");
        } catch (\Exception $e) {
            $this->error("Failed: " . $e->getMessage());
        }
    }
}
