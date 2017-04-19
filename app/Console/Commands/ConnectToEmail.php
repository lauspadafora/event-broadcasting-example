<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Client;
use App\Events\NewIncomingEmailEvent;
use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;

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
            'username'      => 'lauraortizmartinez@gmail.com',
            'password'      => '4m4r1ll0$m0st4z4@.',
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
                        $att->content = base64_encode($att->content);
                        $attachments[] = $att;
                    }                   

                    $newMessage['attachments'] = $attachments;
                    broadcast(new NewIncomingEmailEvent($newMessage));                    
                }
            }            
        }

        /*$mailbox = new ImapMailbox('{pop.gmail.com:995/pop3/ssl}INBOX', 'lauraortizmartinez@gmail.com', '4m4r1ll0$m0st4z4@.', __DIR__);
        //$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/ssl}INBOX', 'lauraortizmartinez@gmail.com', '4m4r1ll0$m0st4z4@.', __DIR__);
        $mailsIds = $mailbox->searchMailbox('UNSEEN');
        foreach($mailsIds as $mail) {
            $mail = $mailbox->getMail($mail);
            var_dump($mail->subject);
        }*/
    }
}
