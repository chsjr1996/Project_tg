<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel col-12 col-md-9 col-lg-10 custom-css fix-position fixed-top">
        <div class="container">
            <!-- Center Of Navbar -->
            <ul class="navbar-nav w-100">
                <div class="w-100 position-relative">
                    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" name="searchTerm" autocomplete="off"
                        v-model="keyW"
                        @input="search"
                        @click="search"
                        @keydown.up="up"
                        @keydown.down="down"
                        @keydown.enter="enter"
                        @keydown.esc="exitSearch"
                        @blur="exitSearch"
                    />
                    <ul class="dropdown-menu w-100"
                        :class="{'show': visible}"
                        v-if="results"
                    >
                        <li v-if="loading" class="dropdown-item">
                            Searching
                            <i class="fa fa-spinner fa-spin"></i>
                        </li>

                        <li :key="result.id" v-for="(result, index) in results">
                            <a class="dropdown-item"
                                :href="'/profile/' + result.id"
                                :class="{'active': isActive(index)}"
                                :ref="'item_' + index"
                            >
                                {{ result.name }}
                            </a>
                        </li>

                        <li class="border-top" v-if="total > 5">
                            <a class="dropdown-item mt-2 text-info"
                                :href="'/profile/results/' + pureKeyW"
                                :class="{'active': isActive(5)}"
                                ref="item_5"
                            >
                                More results ({{ total }})
                            </a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        props: {
            query: ""
        },
        data() {
            return {
                keyW: this.query,
                pureKeyW: "",
                results: [],
                total: 0,
                timeout: null,
                loading: false,
                visible: false,
                current: 0
            }
        },
        methods: {
            search() {

                // Validation
                let re = /[^A-Z0-9ÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ]/gi
                
                // this.$set(this, 'keyW', this.keyW.replace(re, ''))
                
                this.pureKeyW = this.keyW.replace(re, '');

                // Clear timeout
                clearTimeout(this.timeout)

                // if keyW have letters
                if (this.pureKeyW.length > 0) {

                    // Enable loading tip
                    this.loading = true
                    this.total   = 0
                    this.visible = true
                    this.current = 0

                    // Define 500ms timeout to prevent much requests
                    this.timeout = setTimeout(() => {
                    
                        // Request profiles
                        window.axios.get('/profile/search/' + this.pureKeyW)
                        .then(response => {
                        
                            // Show list if have results
                            if (response.data.results.length > 0) {
                                this.results = response.data.results;
                                this.total   = response.data.total;
                                this.loading = false;
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

            // Control active item
            up(e) {
                e.preventDefault();
                if (this.current > 0) {
                    this.current--;   // Up item
                } else if (this.total > 5) {
                    this.current = 5; // Last item (if have more results)
                } else {
                    this.current = (this.results.length -1); // Last item (if doesn't have more results)
                }
            },

            down(e) {
                e.preventDefault();
                if (this.total > 5 && this.current < 5) {
                    this.current++;   // Down item (if have more results)
                } else if (this.current < this.results.length - 1) {
                    this.current++;   // Down item (if doesn't have more results)
                } else {
                    this.current = 0; // First item
                }
            },

            enter() {
                
                if (this.results.length === 0) return false;

                // TODO: Unify redirection code below
                if (this.current != 5) {
                    window.location.href = this.$refs['item_' + this.current][0].href;
                } else {
                    window.location.href = this.$refs.item_5.href;
                }
            },

            // Verify item active
            isActive(index) {
                return index === this.current;
            },

            // Close result list
            exitSearch() {
                setTimeout(() => {
                    this.results = [];
                    this.total   = 0;
                    this.visible = false;
                    this.keyW    = (this.query) ? this.query : '';
                }, 200);
            }
        }
    }
</script>
