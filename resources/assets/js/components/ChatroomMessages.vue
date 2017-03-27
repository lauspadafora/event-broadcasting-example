<template> 
    <chatroom-messages-js inline-template>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Chatroom Messages</div>
                <div class="panel-body">
                    <ul v-for="message in messages">
                        <li>
                            <b>{{ message.name }} says:</b> {{ message.msg }}<br>
                            <small>Sent at: {{ message.date }}</small>
                        </li>
                    </ul>
                </div>
            </div>     
        </div> 
    </chatroom-messages-js> 
</template>
