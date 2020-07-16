<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email for paiement';

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
        // $users = User::select('email')->get();
        $emails = User::pluck('email')->toArray();
        $data = ["title" => "Alert d'abonnement", "body" => "paiement pour le prochaine mois"];
        foreach($emails as $email) {
            Mail::To($email)->send(new SendEmail($data));
        }
    }
}
