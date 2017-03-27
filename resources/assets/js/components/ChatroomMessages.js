module.exports = {
    data() {
        return {
            //Define the array of messages that will be displayed.
            messages: []
        }
    },
    mounted() {
        Echo.channel('new-message-channel')
        .listen('NewMessageEvent', (data) => {
            //Listening to the channel and pushing the new messages in the array.
            this.messages.push({
                msg: data.msg,
                name: data.name,
                date: data.date
            });
        });        
    },
    methods: {      
    }
};