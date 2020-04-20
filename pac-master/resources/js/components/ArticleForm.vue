<template>
    <div class="ArticleForm">
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
                            placeholder="What does it look like? Start basic, what type of garment is it, and what is it chiefly made of? Work your way down the garment, consider; neckline sleeves, chest, waistline, pockets, length, and is it full or fitted? How is it decorated (if at all), and how does it fasten? If you have an idea but are unsure, put “possibly” before the response, e.g. “possibly cotton lawn.” When describing left or right it is from the wearer’s perspective not the viewers."
                            v-model="form.physicalDescription">
                        </textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.has('physicalDescription')"
                              v-text="form.errors.get('physicalDescription')"></span>
                    </div>

                    <div class="mb-4">
                        <label for="designer" class="text-sm block mb-2">Designer/Maker</label>
                        <input
                            type="text"
                            id="designer"
                            class="border p-2 text-xs block w-full rounded"
                            placeholder="Does it have a label, or do you know who made it?"
                            v-model="form.designer">
                        <span class="text-xs italic text-error" v-if="form.errors.has('designer')"
                              v-text="form.errors.get('designer')"></span>
                    </div>

                    <div class="mb-4">
                        <label for="origin" class="text-sm block mb-2">Place of Origin</label>
                            <CountrySelector
                                id="origin"
                                v-model="form.origin">
                            </CountrySelector>
                        <span class="text-xs italic text-error" v-if="form.errors.has('origin')"
                              v-text="form.errors.get('origin')"></span>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3">The answers in the next four fields are the tags that the archives search function will look through, it is basically a summary of the “physical description”. To help this work properly please write as a list of words/phrases each separated by a semi-colon.</h5>
                        <div class="mt-1 title flex justify-between items-center">
                        <label for="materials" class="text-sm block mb-2">Materials</label>
                        <span @mouseover="UpdateToolTipMsg('Cotton; silk; broderie anglaise;')"
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
                        id="materials"
                        class="border border-muted-light p-2 text-xs block w-full rounded"
                        rows="1"
                        placeholder="Write the main fabric first then all other materials you can identify. "
                        v-model="form.materials">
                            </textarea>
                    <span class="text-xs italic text-error"
                          v-if="form.errors.has('materials')"
                          v-text="form.errors.get('materials')">
                            </span>
                </div>

                    <div class="mb-4">
                        <div class="mt-1 title flex justify-between items-center">
                            <label for="techniques" class="text-sm block mb-2">Techniques</label>
                            <span @mouseover="UpdateToolTipMsg('Examples include: pleating; gathering; smocking; piping; tailoring; shirring; insertion lace; ' +
                              '\nfelled seam; drawn thread work; pin-tucks; cording; buttonholes; patch pockets')"
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
                            id="techniques"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="1"
                            placeholder="List any specific techniques you can see that have been used in the making of the main garment."
                            v-model="form.techniques">
                            </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('techniques')"
                              v-text="form.errors.get('techniques')">
                            </span>
                    </div>
                    <div class="mb-4">
                        <div class="mt-1 title flex justify-between items-center">
                            <label for="decoration" class="text-sm block mb-2">Trimmings/Decoration</label>
                            <span @mouseover="UpdateToolTipMsg('Examples include: lace; ruffled flounce; embroidery; goldwork; applique; ' +
                              '\ndeath head buttons; pom-poms; tassels; bows; pinked; slashed ')"
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
                            id="decoration"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="1"
                            placeholder="List all the types of additional decoration applied to the garment. "
                            v-model="form.decoration">
                            </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('decoration')"
                              v-text="form.errors.get('decoration')">
                            </span>
                    </div>

                    <div class="mb-4">
                        <div class="mt-1 title flex justify-between items-center">
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
                            rows="1"
                            placeholder="List anything else that you think someone could search that would be relevant to your garment. Only use single words"
                            v-model="form.searchWords">
                            </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('searchWords')"
                              v-text="form.errors.get('searchWords')">
                            </span>
                    </div>

                    <div class="mb-4">

                        <h3 id="sewingMethod" class="text-sm block mb-2">Sewing Method</h3>
                        <checkbox
                            :items="sewingMethodsItems"
                            checkListName="sewingMethods"
                            @selected="setSelectedCheckBoxes">
                        </checkbox>
                        <span  class="text-xs italic text-error" v-if="form.errors.has('sewingMethod')"
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
    import CountrySelector from "./reuse/CountrySelector";
    import Checkbox from "./reuse/Checkbox";

    export default {
        name:'ArticleForm',
        components: {
            Datepicker,VTooltip,CountrySelector,Checkbox
        },
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    physicalDescription: '',
                    designer:'',
                    searchWords:'',
                    origin:'',
                    materials:'',
                    techniques:'',
                    decoration:''
                }),
                toolTipMsg: 'test',
                formInput: '',
                sewingMethods:[],
                sewingMethodsItems:[
                    { name:'handSewn' , label:'Hand Sewn'},
                    { name:'machineSewn' , label:'Machine Sewn'},
                    { name:'knitted' , label:'Knitted'},
                    { name:'unknown' , label:'Unknown'}
                ]
            };
        },
        methods: {
            UpdateToolTipMsg: function(formInput){
                this.toolTipMsg = formInput;
            },
            setSelectedCheckBoxes: function(selected){
                this.sewingMethods = selected;
            },
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
