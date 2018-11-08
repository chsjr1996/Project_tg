<template>
    <ul class="pagination pagination-centered custom-css" role="pagination" v-if="last_page > 1">
        <li class="page-item" aria-label="« First page"
            :class="{'disabled': current_page == 1}"
        >
            <span class="page-link" v-if="current_page == 1">&laquo;</span>

            <a class="page-link" v-else @click="changePage(1)">&laquo;</a>
        </li>

        <li class="page-item" :class="{'active': page == current_page}" 
            :key="index"
            v-for="(page, index) in pageRange(current_page, last_page)"
        >
            <a class="page-link" v-if="page != current_page" @click="changePage(page)">
                {{ page }}
            </a>
            <span v-else class="page-link">{{ page }}</span>
        </li>

        <li class="page-item" aria-label="Last page »"
            :class="{'disabled': current_page == last_page}"
        >
            <span class="page-link" v-if="current_page == last_page">&raquo;</span>

            <a class="page-link" v-else @click="changePage(last_page)">&raquo;</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['current_page','last_page'],
        methods: {
            pageRange(current, max) {

                // Only calculate range if have more than 3 pages
                if (max < 4) return [1,2,3];

                let arrRange   = [];
                let ini        = 0;
                let calculated = 0;

                // Ini pagination rules
                if (current === 1) ini = 1;
                else if (current === max) ini = (max - 2);
                else ini = (current - 1)

                // End pagination calculation
                calculated = Math.min(ini + 2, max);

                // Make range
                for (let i = ini;i <= calculated; i++) {
                    arrRange.push(i);
                }

                return arrRange;
            },
            changePage(urlPage) {
                
                // Emit event to change page
                this.$parent.$emit('changePage', urlPage)                
            }
        }
    }
</script>
