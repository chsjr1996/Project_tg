<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel col-10 custom-css fix-position fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Center Of Navbar -->
                <ul class="navbar-nav w-100">
                    <div class="w-100 position-relative">
                        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" name="searchTerm" autocomplete="off"
                            v-model="query"
                            @input="search"
                            @keydown.esc="exitSearch"
                            @blur="exitSearch"
                        />
                        <ul class="dropdown-menu w-100"
                            v-bind:class="{'show': visible}"
                            v-if="results"
                        >
                            <li v-if="loading" class="dropdown-item">
                                Searching
                                <i class="fa fa-spinner fa-spin"></i>
                            </li>
                            <li v-bind:key="result.id"
                                v-for="result in results"
                            >
                                <a class="dropdown-item" v-bind:href="'/profile/' + result.id">{{ result.name }}</a>
                            </li>
                            <li v-if="total > 5" class="border-top">
                                <a href="#" class="dropdown-item mt-2 text-info">More results ({{ total }})</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                query: "",
                results: [],
                total: 0,
                timeout: null,
                loading: false,
                visible: false
            }
        },
        methods: {
            search() {
                // Enable loading tip
                this.loading = true
                this.total   = 0;
                this.visible = true

                // if query have letters
                if (this.query.length > 0) {

                    // Clear timeout
                    clearTimeout(this.timeout)

                    // Define 500ms timeout to prevent much requests
                    this.timeout = setTimeout(() => {

                        // Disable loading tip
                        this.loading = false

                        // Request profiles
                        window.axios.get('/profile/search/' + this.query)
                        .then(response => {
                        
                            // Show list if have results
                            if (response.data.results.length > 0) {
                                this.results = response.data.results;
                                this.total   = response.data.total;
                                this.visible = true;
                            } else {
                                this.results = [];
                                this.total   = 0;
                                this.visible = false;
                            }

                        });

                    }, 500);

                } else {
                    this.results = [];
                    this.total   = 0;
                    this.visible = false;
                }
            },
            exitSearch() {
                setTimeout(() => {
                    this.results = [];
                    this.visible = false;
                }, 200);
            }
        }
    }
</script>
