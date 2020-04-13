<template>
    <div id="DatePicker">

    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            Datepicker
        },
        data() {
            return { date: new Date(2016, 9,  16) }
        },

    }
</script>

<style scoped>

</style>
