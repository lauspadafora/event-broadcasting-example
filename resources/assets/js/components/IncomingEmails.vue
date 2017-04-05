<template>
    <incoming-emails-js inline-template>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Incoming Emails</div>
                <div class="panel-body">
                    <div class="row">                   
                        <div class="col-md-6" v-for="email in emails">
                            <div class="well">                            
                                <small>From: {{ email.from }}</small><br/>
                                <small>To: {{ email.to }}</small><br/>
                                <small>Date: {{ email.date }}</small><br/>
                                <span><strong>Subject: </strong>{{ email.subject }}</span><br/>
                                <span><strong>Body: </strong>{{ email.body_text }}</span>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
    </incoming-emails-js>
</template>
