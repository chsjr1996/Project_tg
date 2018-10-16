<template>
    <div class="modal fade profile-editor" id="profileEditor" tabindex="-1" role="dialog" aria-labelledby="profileEditorLabel" aria-hidden="true">
        <div class="modal-dialog custom-css" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileEditorLabel">{{ name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="formSubmit" @keyup.ctrl.enter="formSubmit">
                    <input type="hidden" name="content" :value="content" />
                    <div class="modal-body">
                        <vue-editor
                            v-model="content"
                            :editorToolbar="customToolbar"
                        ></vue-editor>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor';

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                id: "",
                name: "",
                content: '',
                customToolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, {'list': 'bullet'}]
                ]
            };
        },
        methods: {
            setProps: function (id, name, content) {
                this.id          = id
                this.name        = name
                this.content     = content
            },
            formSubmit(e) {
                e.preventDefault();

                let bus = this;

                window.axios.put('/profile/update/section', {
                    id: this.id,
                    content: this.content
                })
                .then(function (response) {
                    // Refresh sections
                    bus.$parent.$emit('updated', 'success')
                    $("#profileEditor").modal('hide')
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
