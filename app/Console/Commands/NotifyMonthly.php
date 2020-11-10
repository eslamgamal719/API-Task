<?php

namespace App\Console\Commands;

use App\User;
use App\Worker;
use App\Mail\MonthlyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class NotifyMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to admins every month before two days of payment salaries';

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

        $workers = Worker::select('salary')->get();

        $salaries_total = 0;

        foreach($workers as $worker) {
            $salaries_total += $worker->salary;
        }

        foreach($adminEmails as $email) {
            Mail::to($email)->send(new MonthlyEmail($salaries_total));
        }
    }
}
