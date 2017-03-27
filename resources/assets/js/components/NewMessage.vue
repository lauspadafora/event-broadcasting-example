<template>   
    <new-message-js inline-template>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Send your message</div>
                <div class="panel-body">
                    <form v-on:submit.prevent="sendMessage" class="form-horizontal" id='send-message-form' name='send-message-form'>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input v-model="name" id="name" type="text" class="form-control" name="name" placeholder="Type your name here" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-md-3 control-label">Message</label>
                            <div class="col-md-9">
                                <textarea v-model="msg" id="msg" type="text" class="form-control" name="msg" rows="4" required>Type your message here</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </new-message-js>
</template>
