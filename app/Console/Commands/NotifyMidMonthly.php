<?php

namespace App\Console\Commands;

use App\User;
use App\Worker;
use App\Mail\MidMonthlyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class NotifyMidMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:mid-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to admins before two days of payment bonus';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $adminEmails = User::pluck('email')->toArray();

        $workers = Worker::select('salary', 'bonus')->get();

        $bonus_total = 0;

        foreach($workers as $worker) {
            $bonus_total += $worker->salary * $worker->bonus;
        }

        foreach($adminEmails as $email) {
            Mail::to($email)->send(new MidMonthlyEmail($bonus_total));
        }
    }
}
