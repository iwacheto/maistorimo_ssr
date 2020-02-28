<?php

namespace App\Jobs;

use App\ContactAnalytic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ContactsAnalitycJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // $data,$myCookieValue,$session,$name,$dateTime,$today,$analitycs
    protected  $data;
    protected  $myCookieValue;
    protected  $session;
    protected  $name;
    protected  $dateTime;
    protected  $today;
    protected  $analitycs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$myCookieValue,$session,$name,$dateTime,$today,$analitycs)
    {
        $this->data=$data;
        $this->myCookieValue=$myCookieValue;
        $this->session=$session;
        $this->name=$name;
        $this->dateTime=$dateTime;
        $this->today=$today;
        $this->analitycs=$analitycs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (count($this->analitycs) < 1) {

            $analitycs = new ContactAnalytic;

            $analitycs = new ContactAnalytic();

            $analitycs->user_id = $this->data['user'];
            $analitycs->type = $this->data['object_type'];
            $analitycs->count = 1;
            $analitycs->unique_count = 1;
            $analitycs->date = $this->dateTime;
            $analitycs->save();
            return ('Zapisyt e sazdaden');
        }
        elseif ($this->name) {
            $count = $this->analitycs[0]->count;
            $count = $count + 1;
            $this->analitycs[0]->update([
                'count' => $count,
            ]);
            return 'Броячът е увеличен';
         }
        else {
            $count = $this->analitycs[0]->count;
            $count = $count + 1;
            $uniqueCount = $this->analitycs[0]->unique_count;
            $uniqueCount = $uniqueCount + 1;
            $this->analitycs[0]->update([
                'count' => $count,
                'unique_count' => $uniqueCount,
            ]);
            return 'Броячите са увеличени';
        }
    }
}
