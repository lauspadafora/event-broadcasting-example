module.exports = {
    data() {
        return {
            emails: []
        }
    },
    mounted() {
        Echo.channel('new-incoming-email-channel')
            .listen('NewIncomingEmailEvent', (data) => {
                this.emails.push({
                    from: data.email.from[0].mail + ' <' + data.email.from[0].personal + '>',
                    to: data.email.to[0].mail + ' <' + data.email.to[0].personal + '>',
                    date: data.email.date.date,
                    subject: data.email.subject,
                    message_id: data.email.message_id,
                    body_text: data.email.body_text
                });
            });
    },
    methods: {}
};