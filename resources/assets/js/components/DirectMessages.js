module.exports = {
    data() {
        return {
            directMessages: []
        }
    },
    mounted() {
        Echo.channel('new-direct-message-channel')
            .listen('NewDirectMessageEvent', (data) => {
                console.log(data)
                this.directMessages.push({
                    created_at: data.directMessage.created_at,
                    recipient_screen_name: data.directMessage.recipient_screen_name,
                    sender_screen_name: data.directMessage.sender_screen_name,
                    text: data.directMessage.text
                });
            });
    },
    methods: {}
};