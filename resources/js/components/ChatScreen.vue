<template>
    <div class="container fix-container custom-css">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5 mb-5">
                <chat :user="user"></chat>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user']
    }
</script>
