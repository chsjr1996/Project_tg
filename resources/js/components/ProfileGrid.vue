<template>
    <div class="container fix-container box-grid custom-css">
        <div class="row justify-content-center">

            <div class="col-md-10 mt-5 mb-5">
                <div class="card card-default">
                    <div class="card-header">
                        <p class="m-0"><span>{{ total }}</span> results for: <span>{{ query }}</span></p>
                    </div>

                    <div class="card-body d-flex align-content-start flex-wrap">
                        <div class="col-12 col-md-4 col-xl-3 float-left p-2 box-grid__frame"
                            :key="result.id"
                            v-for="result in results"
                        >
                            <div class="border">
                                <div class="adjust-img-profile img-grid custom-css">
                                    <a :href="'/profile/' + result.id">
                                        <img
                                            v-if="result.user_photo"
                                            :src="'/avatars/' + result.user_photo"
                                            :alt="result.name"
                                        />
                                        <i class="img-thumbnail fa fa-camera-retro icon-grid"
                                            v-else
                                        ></i>
                                    </a>
                                </div>
                                <a class="d-block text-center"
                                    :href="'/profile/' + result.id"
                                >
                                    <strong>{{ result.name }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    <pagination 
                        :current_page="current_page"
                        :last_page="last_page"
                    ></pagination>
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

            // Listener for 'changePage' event of pagination component
            this.$on('changePage', function(numPage) {
                this.loadGrid(numPage)
            })
        },
        data() {
            return {
                results: [],
                total: 0,
                current_page: 0,
                last_page: 0,
            }
        },
        methods: {
            loadGrid(numPage) {

                // Default url
                let urlGet = '/profile/loadResults/' + this.query + '/true';

                // Increments the url with page number
                if (numPage) urlGet+= "?page=" + numPage;

                // Execute axios
                window.axios.get(urlGet)
                .then(response => {

                    // This obj is a representation of a Laravel pagination
                    const obj         = response.data.results;

                    this.current_page = obj.current_page;
                    this.last_page    = obj.last_page;

                    if (obj.data.length > 0) {
                        this.results = obj.data;
                        this.total   = obj.total;
                    }
                });
            }
        }
    }
</script>
