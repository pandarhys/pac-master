<style scoped>
    .tooltip {
        display: block !important;
        z-index: 10000;

    .tooltip-inner {
        background: black;
        color: white;
        border-radius: 16px;
        padding: 5px 10px 4px;
    }

    .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
        border-color: black;
        z-index: 1;
    }

    &[x-placement^="top"] {
         margin-bottom: 5px;

    .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }
    }

    &[x-placement^="bottom"] {
         margin-top: 5px;

    .tooltip-arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-top-color: transparent !important;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }
    }

    &[x-placement^="right"] {
         margin-left: 5px;

    .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent !important;
        border-top-color: transparent !important;
        border-bottom-color: transparent !important;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }
    }

    &[x-placement^="left"] {
         margin-right: 5px;

    .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }
    }

    &[aria-hidden='true'] {
         visibility: hidden;
         opacity: 0;
         transition: opacity .15s, visibility .15s;
     }

    &[aria-hidden='false'] {
         visibility: visible;
         opacity: 1;
         transition: opacity .15s;
     }
    }
</style>

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
                        <FileUpload message='Upload Pictures Here'></FileUpload>
                    </div>
<!--                    optional input-->

                    <div class="mb-4">
                        <label for="physicalDescription" class="text-sm block mb-2">Physical Description</label>
                        <textarea
                            id="physicalDescription"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="7"
                            placeholder="What does it look like? Start basic, what type of garment is it, and what is it chiefly made of? Work your way down the garment, consider; neckline"
                            v-model="form.physicalDescription">
                        </textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.has('physicalDescription')"
                              v-text="form.errors.get('physicalDescription')"></span>
                    </div>
<!--                    one word descriptions-->
                    <div class="mb-4">
                        <div class="title flex justify-between items-center">
                            <label for="searchWords" class="text-sm block mb-2">Item Themes</label>
                            <span @mouseover="UpdateToolTipMsg(
                                'The occasion-(wedding; debutante; workwear; travelling; trousseau; mourning; maternity)' +
                                '\nColloquial terms for time period-(Regency; Rocco; Victorian; Edwardian)' +
                                '\nBroad category of the garment-(underwear; outerwear; evening; day)' +
                                '\nMain colour or pattern-(pink; sheer; checked; multi-coloured; textured)')"
                              v-tooltip="{
                              content: toolTipMsg,
                              trigger: 'hover',
                              placement: 'bottom-center',
                              classes: ['info'],
                              targetClasses: ['it-has-a-tooltip'],
                              delay: {
                                show: 100,
                              },
                            }">Info</span>
                        </div>
                            <textarea
                                id="searchWords"
                                class="border border-muted-light p-2 text-xs block w-full rounded"
                                rows="7"
                                placeholder="List anything else that you think someone could search that would be relevant to your garment. Only use single words"
                                v-model="form.searchWords">
                            </textarea>
                            <span class="text-xs italic text-error"
                                  v-if="form.errors.has('searchWords')"
                                  v-text="form.errors.get('searchWords')">
                            </span>
                    </div>
                    <div class="mb-4">
                        <label for="sewingMethod" class="text-sm block mb-2">Sewing Method</label>

                        <textarea
                            id="sewingMethod"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="7"
                            v-model="form.sewingMethod">
                        </textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.has('sewingMethod')"
                              v-text="form.errors.get('sewingMethod')"></span>
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
    import VTooltip from 'v-tooltip'

    export default {
        components: {
            Datepicker,VTooltip
        },
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    physicalDescription: '',
                    searchWords:''
                }),
                toolTipMsg: 'test',
                formInput: '',
                sewingMethods: ['Hand Sewn', 'Machine Sewn', 'Knitted', 'Unknown']
            };
        },
        methods: {
            UpdateToolTipMsg: function(formInput){
                this.toolTipMsg = formInput;
            },
            async Submit() {
                this.form
                    .post('/article')
                    .then(article => this.$emit('completed', article));
            }
        }
    }
</script>
