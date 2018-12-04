<template>
    <div class="container fix-container custom-css">
        <div class="row justify-content-center">

            <!-- Sections -->
            <div class="col-md-10 mt-5" v-bind:key="section.id" v-for="section in sections">
                <div class="card mb-5">

                    <div :id="section.id" class="card-header bg-custom custom-css">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="fa-2x m-0">
                                    <i class="fa ml-2 mr-2" :class="section.icon"></i>
                                    {{ section.name }}
                                </h2>
                            </div>
                            <div class="col-2 text-right" v-if="editable && section.id != 4">
                                <p class="m-0 pl-3 pr-3 btn bg-dark"
                                    v-on:click="modal(
                                        section.id,
                                        section.name,
                                        section.content
                                    )"
                                >
                                    <i class="fa fa-pencil-alt text-white"></i>
                                </p>
                            </div>
                            <div class="col-2 text-right" v-else-if="!editable && section.id == 4">
                                <p class="m-0 pl-3 pr-3 btn bg-dark"
                                    v-on:click="modal(
                                        section.id,
                                        section.name,
                                        section.content
                                    )"
                                >
                                    <i class="fa fa-plus text-white"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body"
                          v-if="section.id != 4 && section.content"
                          v-html="section.content"
                    ></div>

                    <div class="card-body"
                          v-if="section.id == 4 && section.content.length > 0"
                    >
                      <div v-for="comments in section.content">
                        <div class="card w-75 ml-auto mr-auto m-3">
                          <div class="card-header">
                            <div class="row">
                              <p class="m-0 ml-2">User:
                                <a :href="'/profile/' + comments.id">
                                  {{ comments.name }}
                                </a>
                              </p>
                            </div>
                          </div>
                          <div class="card-body" v-html="comments.comment">

                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <profile-editor ref="modal"></profile-editor>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        mounted() {
            // Load sections and your data
            this.loadSections()
            this.$on('updated', function(v) {
                this.loadSections()
            })
        },
        data() {
            return {
                sections: null,
                editable: null
            }
        },
        methods: {
            // Get /home/loadSections
            loadSections() {
                window.axios.get('/profile/loadSections/' + this.id)
                .then(response => {
                    this.sections = response.data.sections
                    this.editable = response.data.editable
                })

            },
            // pass data and active modal with editor
            modal: function (id, name, content, profile_id) {

                if (id == 4) {
                    content    = null
                    profile_id = this.id
                } else {
                    profile_id = null
                }

                this.$refs.modal.setProps(id, name, content, profile_id)
                $("#profileEditor").modal('show')
            }
        }
    }
</script>
