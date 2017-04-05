<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Client;
use App\Events\NewIncomingEmailEvent;

class ConnectToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'connect_to_email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connection to the email server';

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
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => '',
            'password'      => '',
        ]);

        //Connect to the IMAP Server
        $oClient->connect();

        //Get all Mailboxes
        $aMailboxes = $oClient->getFolders();

        foreach($aMailboxes as $oMailbox) {            
            //Get all Messages of the current Mailbox              
            if ($oMailbox->fullName === "INBOX") {
                $unseenMessages = $oMailbox->getMessages('SINCE 01-Apr-2017 UNSEEN');              
                foreach($unseenMessages as $oMessage) {
                    $newMessage = Array();
                    $newMessage['message_id'] = $oMessage->message_id;
                    $newMessage['subject'] = $oMessage->subject;
                    $newMessage['date'] = $oMessage->date;
                    $newMessage['from'] = $oMessage->from;
                    $newMessage['to'] = $oMessage->to;
                    $newMessage['cc'] = $oMessage->cc;
                    $newMessage['bcc'] = $oMessage->bcc;
                    $newMessage['sender'] = $oMessage->sender;
                    $newMessage['body_text'] = $oMessage->getTextBody();
                    $newMessage['body_html'] = $oMessage->getHTMLBody();

                    $attachments = Array();

                    foreach ($oMessage->attachments as $att) 
                    {
                        $attachments[] = $att;
                    }                   

                   // $newMessage['attachments'] = $oMessage->attachments;
                    broadcast(new NewIncomingEmailEvent($newMessage));                    
                }
            }            
        }
    }
}
