<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Message;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\User;
use App\Mail\NewArrivals;
class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to users';
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
     * @return mixed
     */
    public function handle()
    {
        $now = date("Y-m-d H:i", strtotime(Carbon::now()));
        logger($now);
        $messages = Message::get();
        if($messages !== null){
            //Get all messages that their dispatch date is due
            $messages->where('date_string',  $now)->each(function($mg) {
                 
                if($mg->delivered == 'NO')
                {                   
                        dispatch(new SendMailJob(
                            $mg->email, 
                            new NewArrivals($mg, $mg))
                        );
                   
                    $mg->delivered = 'YES';
                    $mg->save();   
                }     
                
            });
        }
    }
}