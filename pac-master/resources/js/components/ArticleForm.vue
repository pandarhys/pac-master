<template>

</template>

<script>
    export default {
        name: "ArticleForm.vue",
        data: {
            form: new Form({
                name: '',
                description: ''
            })
        },
        methods: {
            onSubmit() {
                this.form.post('/projects')
                    .then(response => alert('Wahoo!'));
            }
     }
    };
</script>
<style scoped>

</style>
