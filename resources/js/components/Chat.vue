<template>
    <div class="card card-default">
        <div class="card-header bg-dark">
            <p class="m-0 float-left text-white">
                <strong>{{ receptor.name }}</strong>
            </p>
            <a class="m-0 d-block float-right text-white cursor-pointer custom-css"
                v-if="origin == 'boxChat'"
                :href="'/chat/profile/' + receptor.id"
            >
                <i class="fa fa-expand-arrows-alt" title="fullscreen"></i>
            </a>
        </div>

        <div class="col-12 box-chat custom-css" v-if="messages.length > 0">
            <div class="row"
                :key="message.id"
                :class="{'justify-content-end': message.user_id == receptor.id}"
                v-for="message in messages"
            >
                <div class="card-body col-8 p-0 pt-3 pl-3 pr-3">
                    <div class="card border-dark mb-3">
                        <div class="card-header">
                            <p class="m-0 float-left">{{ message.user_name }}</p>
                            <p class="m-0 float-right">
                                <i class="fa fa-clock" :title="message.created_at.date | formatDate"></i>
                            </p>
                        </div>
                        <div class="card-body text-dark">
                            <p class="card-text">{{ message.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" v-else>
            <div class="card-body col-6 m-auto">
                <div class="card border-dark">
                    <div class="card-header text-dark">
                        <p class="m-0">No messages sent or received, be the first to send!!!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 clearfix">
                    <div class="col-10 p-0 pr-3 float-left">
                        <input id="input-field" type="text" name="message" class="form-control" placeholder="Type your message here..."
                            v-model="newMessage"
                            @keyup.enter="sendMessage"
                        />
                    </div>

                    <div class="col-2 float-right text-right p-0">
                        <button id="btn-chat" class="btn btn-primary" @click="sendMessage">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'origin'],
        mounted() {
            this.fetchMessages()
        },
        data() {
            return {
                messages: [],
                newMessage: '',
                receptor: JSON.parse(this.user)
            }
        },
        filters: {
            formatDate: function (value) {

                if (!value) return ''
                
                let arrTmp = value.substr(0, 10).split('-')

                let text   = arrTmp[2] + '/' + arrTmp[1] + '/' + arrTmp[0]

                text      += ' (' + value.substr(11, 5) + ') '

                return text
            }
        },
        methods: {
            fetchMessages() {
                window.axios.get('/chat/messages/' + this.receptor.id)
                .then(response => {
                    this.messages = response.data
                });
            },
            sendMessage() {

                if (!this.newMessage) return false;

                let data = {
                    receptor: this.receptor.id,
                    text: this.newMessage
                }

                window.axios.post('/chat/messages', {data})
                .then(response => {
                    this.messages.push(
                        {
                            user_id: null,
                            user_name: 'Me',
                            created_at: {
                                date: this.now()
                            },
                            text: this.newMessage
                        }
                    );
                    this.newMessage = ''
                });
            },
            now() {
                const date   = new Date()
                const month  = (date.getMonth() + 1)
                const day    = date.getDate()
                const year   = date.getFullYear()
                const time   = date.getHours() + ':' + date.getMinutes()
                return year + '-' + month + '-' + day + ' ' + time
            }
        }
    }
</script>
