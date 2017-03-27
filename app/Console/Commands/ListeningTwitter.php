<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TwitterStreamingApi;
use App\Events\NewDirectMessageEvent;
use App\Events\NewMentionEvent;

class ListeningTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listening_twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listening Twitter';

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
        TwitterStreamingApi::userStream()
            ->onEvent(function(array $event) {
                var_dump($event);
                if (isset($event['direct_message'])) {                    
                    broadcast(new NewDirectMessageEvent($event['direct_message']));
                }
                if (isset($event['entities']['user_mentions']) && sizeof($event['entities']['user_mentions']) > 0) {             
                    broadcast(new NewMentionEvent($event));
                }
            })
            ->startListening();
    }
}
