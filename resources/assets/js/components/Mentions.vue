<template>
    <mentions-js inline-template>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Twitter Mentions</div>
                <div class="panel-body">
                    <ul v-for="m in mentions">
                        <li>
                            {{ m.text }}
                            <br/>
                            <small>From: {{ m.user_screen_name }}</small>
                            <br/>
                            <small>Sent at: {{ m.created_at }}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </mentions-js>
</template>
