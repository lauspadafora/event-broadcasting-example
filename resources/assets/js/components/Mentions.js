module.exports = {
    data() {
        return {
            mentions: []
        }
    },
    mounted() {
        Echo.channel('new-mention-channel')
            .listen('NewMentionEvent', (data) => {
                this.mentions.push({
                    created_at: data.mention.created_at,
                    user_screen_name: data.mention.user.screen_name,
                    text: data.mention.text
                });
            });
    },
    methods: {}
};