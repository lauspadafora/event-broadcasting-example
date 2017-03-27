module.exports = {
    data() {
        return {
            messages: [],
            name: '',
            msg: ''
        }
    },
    mounted() {                 
    },

    methods: {
        sendMessage() {            
            // Sending message to the backend.
            axios.post('/send-message', { name: this.name, msg: this.msg, date: (new Date()).toLocaleString() }).then((response) => {
                //Clearing the message field.
                this.msg = '';
            });
        }
    }
};