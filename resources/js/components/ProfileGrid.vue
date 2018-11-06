<template>
    <div class="container fix-container box-grid custom-css">
        <div class="row justify-content-center">

            <div class="col-md-10 mt-5 mb-5">
                <div class="card card-default">
                    <div class="card-header">
                        <p class="m-0"><span>{{ total }}</span> results for: <span>{{ query }}</span></p>
                    </div>

                    <div class="card-body d-flex align-content-start flex-wrap">
                        <div class="col-3 float-left p-2 box-grid__frame"
                            v-bind:key="result.id"
                            v-for="result in results"
                        >
                            <div class="border">
                                <div class="adjust-img-profile img-grid custom-css">
                                    <a v-bind:href="'/profile/' + result.id">
                                        <img
                                            v-if="result.user_photo"
                                            v-bind:src="'/avatars/' + result.user_photo"
                                            v-bind:alt="result.name"
                                        />
                                        <i class="img-thumbnail fa fa-camera-retro icon-grid"
                                            v-else
                                        ></i>
                                    </a>
                                </div>
                                <a class="d-block text-center"
                                    v-bind:href="'/profile/' + result.id"
                                >
                                    <strong>{{ result.name }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            query: ""
        },
        mounted() {
            this.loadGrid()
        },
        data() {
            return {
                arrPhoto: [],
                results: [],
                total: 0
            }
        },
        methods: {
            loadGrid() {
                window.axios.get('/profile/loadResults/' + this.query + '/true')
                .then(response => {
                    if (response.data.results.length > 0) {
                        this.results = response.data.results;
                        this.total   = response.data.total;
                    }
                });
            }
        }
    }
</script>
