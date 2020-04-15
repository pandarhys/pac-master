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
                            placeholder="What is it? Keep it short, e.g. “Pink Corset Cover”."
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
                            placeholder="One sentence to briefly summarise the garment, e.g. “A delicate pale salmon pink cotton corset cover with lace insertion detail.”"
                            v-model="form.description">
                        </textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.has('description')"
                              v-text="form.errors.get('description')"></span>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-2">Estimate Date Range</h3>
                        <p class="mb-2">When was it made? If you are unsure then keep it broad, or you can put it to the community in our “history mystery” section. If you know the exact date just put that same date in both boxes.</p>
                        <datepicker placeholder="Earliest Date" class="mb-2">
                        </datepicker>
                        <datepicker placeholder="Latest Date" class="mb-2">
                        </datepicker>
                    </div>

                    <div class="mb-4">
                        <FileUpload message='body it'></FileUpload>
                    </div>
                    <footer class="flex justify-end">
                        <button type="button" class="button is-outlined mr-4" @click="$modal.hide('new-article2')">Cancel
                        </button>
                        <button class="button" :disabled="form.errors.any()">Create Article</button>
                    </footer>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Form from '../core/Form.js'
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker
        },
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
