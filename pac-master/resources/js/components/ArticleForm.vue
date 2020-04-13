<template>
    <div id="ArticleForm">
        <form @submit.prevent="Submit" @keydown="form.errors.clear($event.target.name)">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input
                            type="text"
                            id="title"
                            class="border p-2 text-xs block w-full rounded"
                            v-model="form.title">
                        <span class="text-xs italic text-error" v-if="form.errors.has('title')"
                              v-text="form.errors.get('title')"></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea
                            id="description"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="7"
                            v-model="form.description"></textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.has('description')"
                              v-text="form.errors.get('description')"></span>
                    </div>

                    <div class="mb-4">
                        <FileUpload></FileUpload>
                    </div>

                    <div class="mb-4">
                        <div class="example">
                            <h3>Default datepicker</h3>
                            <PACDatePicker placeholder="Select Date"></PACDatePicker>
                        </div>
                    </div>
                </div>
                <footer class="flex justify-end">
                    <button type="button" class="button is-outlined mr-4" @click="$modal.hide('new-article2')">Cancel
                    </button>
                    <button class="button" :disabled="form.errors.any()">Create Article</button>
                </footer>
            </div>
        </form>
    </div>
</template>

<script>
    import Form from '../core/Form.js'

    export default {
        data() {
            return {
                form: new Form({
                    title: '',
                    description: ''
                })
            };
        },
        methods: {
            async Submit() {
                this.form
                    .post('/article')
                    .then(article => this.$emit('completed', article));
            }
        }
    }
</script>
<style scoped>
</style>
