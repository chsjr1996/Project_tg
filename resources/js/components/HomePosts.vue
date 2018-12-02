<template>
    <div class="container fix-container custom-css post-card">
        <div class="row justify-content-center">
            <div class="col-8 col-md-10 col-lg-12 mt-3">
                <div class="card mb-5" :class="focusEditor">
                    <div class="card-header bg-custom">
                        <div class="row">
                            <div class="col-12">
                                <p class="m-0">
                                    <i class="fa fa-book ml-2 mr-2"></i>
                                    Posts
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body post-editor"> 
                        <form @submit="postSubmit" @keyup.ctrl.enter="postSubmit">
                            <input type="hidden" name="content" :value="content">
                            <vue-editor
                                @focus="editorFocus"
                                @blur="editorBlur"
                                v-model="content"
                                :editorToolbar="customToolbar"
                            ></vue-editor>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        <p @click="resetPost" class="m-0 pl-3 pr-3 btn btn-danger">
                            <i class="fa fa-times text-white"></i>
                        </p>
                        <p @click="postSubmit" class="m-0 pl-3 pr-3 btn btn-info">
                            <i class="fa fa-check text-white"></i>
                        </p>
                    </div>
                </div>
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
                content: '',
                focusEditor: '',
                customToolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, {'list': 'bullet'}]
                ]
            };
        },
        methods: {
            editorFocus() {
                this.focusEditor = "focus"
            },
            editorBlur() {
                this.focusEditor = ""
            },
            resetPost() {
                this.content = ""
            },
            postSubmit(e) {
                e.preventDefault()
                alert(this.content)
            }
        }
    }
</script>
