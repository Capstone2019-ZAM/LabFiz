<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Report;
use Datetime;
use DateInterval;



class InpsectionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily email to inspectors for outstanding inspections';

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
        //get all over due reports
        //update status
        try{
        $today = date('Y-m-d');
        Report::whereDate('due_date','<',$today)->where('status','Pending')->update(['status' =>'Overdue']);
        
        
        //get all near due reports
        // send email to assigned
        $soon = new DateTime();
        $soon->add(new DateInterval('P5D'))->format('Y-m-d');
        //$near_due = Report::whereBetween('due_date',[$soon,$today])->where('status','Pending')->get();        
        $emails_neardue = User::leftJoin('reports','reports.assigned_to','=','users.id')->whereBetween('due_date',[$soon,$today])->where('status','Pending')->get(['first_name','email']);
        foreach ( $emails_neardue as $e){

            $data = array('name' => $e->first_name);
            $to_name = $e->first_name;
            $to_email = $e->email;
            Mail::send('emails.reminder', $data,
                 function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Inspection Reminder');
                    $message->from('labfiz.noreply@gmail.com','LabFiz Admin');
                });
   
        }
        $this->info('Daily status update and reminder job done');

    }
    catch (Exception $ex) {

    }
        //get counts for all status of reports
        //send email to admins
       
    }
}
