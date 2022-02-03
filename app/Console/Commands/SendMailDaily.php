<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:send_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an daily email to all advertisers who have ads the next day as a remainder';

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
        $advertisers = User::whereHas('roles', function ($query){
            $query->where('name', 'Advertiser');
        })->whereHas('ads', function ($q){
            $q->where('start_date', date("Y-m-d", strtotime('tomorrow')));
        })->get();

        foreach ($advertisers as $advertiser){
            Mail::raw('You have an ad tommorow', function ($mail) use ($advertiser){
                $mail->from('advertising@mail.com');
                $mail->to($advertiser->email)->subject('Ad Reminder');
            });
        }
        $this->info('Daily mails has been send successfully');
    }
}
