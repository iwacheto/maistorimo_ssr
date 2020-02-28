<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\ObjectAnalytic;

class ObjectAnalitycJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $data;
    protected $dateTime;
    protected $today;
    protected $analitycs;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name,$data,$dateTime,$today,$analitycs)
    {
        $this->name=$name;
        $this->data=$data;
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
            $analitycs = new ObjectAnalytic;
            $analitycs->user_id = $this->data['user'];
            $analitycs->object_id = $this->data['project'];
            $analitycs->object_type = $this->data['object_type'];
            $analitycs->count = 1;
            $analitycs->unique_count = 1;
            $analitycs->date = $this->dateTime;
            $analitycs->save();
            return ('Записът е създаден');
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
