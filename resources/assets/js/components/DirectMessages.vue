<template> 
    <direct-messages-js inline-template>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Twitter Direct Messages</div>
                <div class="panel-body">
                      <ul v-for="dm in directMessages">
                        <li>
                            {{ dm.text }}<br/>
                            <small>From: {{ dm.sender_screen_name }}</small><br/>
                            <small>To: {{ dm.recipient_screen_name }}</small><br/>
                            <small>Sent at: {{ dm.created_at }}</small>
                        </li>
                    </ul>
                </div>
            </div>     
        </div> 
    </direct-messages-js> 
</template>
