<template>
    <div>
        <div class="chat-button custom-css bg-dark"
            :class="{'chat-visible': chatVisible}"
            @click="openChat"
        >
            <i class="fa fa-2x" :class="chatIcon"></i>
        </div>
        <div v-if="chatVisible" class="box-chat-min custom-css">
            <chat :user="JSON.stringify(receptor)" :origin="'boxChat'"></chat>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'name'],
        data() {
            return {
                chatVisible: false,
                chatIcon: "fa-comment",
                receptor: {
                    id: this.id,
                    name: this.name
                }
            }
        },
        methods: {
            openChat() {
                this.chatVisible = !this.chatVisible
                this.chatIcon    = (this.chatVisible) ? 'fa-times' : 'fa-comment'
            }
        }
    }
</script>
