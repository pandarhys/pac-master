<template>
    <div class="ArticleForm">
        <form @submit.prevent="Submit" @click="form.errors.clear($event.target.id,false)">
            <div class="flex">
                <div class="flex-1 w-4/5">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input
                            type="text"
                            id="title"
                            class="border p-2 text-xs block w-full rounded"
                            placeholder="What is it? Keep it short, e.g. “Pink Corset Cover”."
                            v-model="form.title">
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('title')"
                              v-text="form.errors.get('title')">
                        </span>
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
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('description')"
                              v-text="form.errors.get('description')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 class="mb-2">Estimate Date Range</h3>
                        <p class="mb-2">When was it made? If you are unsure then keep it broad, or you can put it to the community in our “history mystery” section. If you know the exact date just put that same date in both boxes.</p>
                        <div class="mb-4 flex">
                            <datepicker placeholder="Earliest Date" class="mb-2" v-model="form.earliest_date" :required="true" id="earliest_date"></datepicker>
                            <span class="text-xs italic text-error"
                                  v-if="form.errors.has('earliest_date')"
                                  v-text="form.errors.get('earliest_date')">
                            </span>
                            <datepicker placeholder="Latest Date" class="mb-2" v-model="form.latest_date" :required="true" id="latest_date"></datepicker>
                            <span class="text-xs italic text-error"
                                  v-if="form.errors.has('latest_date')"
                                  v-text="form.errors.get('latest_date')">
                            </span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <FileUpload v-show='CreateForm' message='Upload Pictures Here' @storeFileName="storeImagePath">
                        </FileUpload>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('image_file_names')"
                              >Upload at Least One Image
                        </span>
                    </div>
<!--optional input-->
                    <div class="mb-4">
                        <label for="physical_description" class="text-sm block mb-2">Physical Description</label>
                        <textarea
                            id="physical_description"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="7"
                            placeholder="What does it look like? Start basic, what type of garment is it, and what is it chiefly made of? Work your way down the garment, consider; neckline sleeves, chest, waistline, pockets, length, and is it full or fitted? How is it decorated (if at all), and how does it fasten? If you have an idea but are unsure, put “possibly” before the response, e.g. “possibly cotton lawn.” When describing left or right it is from the wearer’s perspective not the viewers."
                            v-model="form.physical_description">
                        </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('physical_description')"
                              v-text="form.errors.get('physical_description')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <label for="designer" class="text-sm block mb-2">Designer/Maker</label>
                        <input
                            type="text"
                            id="designer"
                            class="border p-2 text-xs block w-full rounded"
                            placeholder="Does it have a label, or do you know who made it?"
                            v-model="form.designer">
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('designer')"
                              v-text="form.errors.get('designer')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <label for="origin" class="text-sm block mb-2">Place of Origin</label>
                            <CountrySelector
                                id="origin"
                                v-model="form.origin"
                                :countrySeleted.sync="form.origin"
                            >
                            </CountrySelector>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('origin')"
                              v-text="form.errors.get('origin')">
                        </span>
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
                                }">Info
                            </span>
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
                            v-model="form.decorations">
                            </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('decoration')"
                              v-text="form.errors.get('decoration')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="mt-1 title flex justify-between items-center">
                            <label for="search_words" class="text-sm block mb-2">Item Themes</label>
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
                            id="search_words"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="1"
                            placeholder="List anything else that you think someone could search that would be relevant to your garment. Only use single words"
                            v-model="form.search_words">
                            </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('search_words')"
                              v-text="form.errors.get('search_words')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="sewingMethod" class="text-sm block mb-2">Sewing Methods</h3>
                        <checkbox
                            :items="sewing_methodsItems"
                            :checkedItems.sync="form.sewing_methods"
                            checkListName="sewing_methods">
                        </checkbox>
                        <span  class="text-xs italic text-error"
                               v-if="form.errors.has('sewingMethod')"
                               v-text="form.errors.get('sewingMethod')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="classification" class="text-sm block mb-2">Classification</h3>
                        <checkbox
                            :items="classificationItems"
                            :checkedItems.sync="form.classification"
                            checkListName="classification">
                        </checkbox>
                        <span  class="text-xs italic text-error"
                               v-if="form.errors.has('classification')"
                               v-text="form.errors.get('classification')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="cut" class="text-sm block mb-2">Cut</h3>
                        <checkbox
                            :items="cutItems"
                            :checkedItems.sync="form.cut"
                            checkListName="cut">
                        </checkbox>
                        <span  class="text-xs italic text-error"
                               v-if="form.errors.has('cut')"
                               v-text="form.errors.get('cut')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="fastenings" class="text-sm block mb-2">Fastenings</h3>
                        <checkbox
                            :items="fasteningItems"
                            :checkedItems.sync="form.fastenings"
                            checkListName="fastenings">
                        </checkbox>
                        <span  class="text-xs italic text-error" v-if="form.errors.has('fastenings')"
                               v-text="form.errors.get('fastenings')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="stiffening" class="text-sm block mb-2">Stiffening / Lining / Padding</h3>
                        <checkbox
                            :items="stiffeningItems"
                            :checkedItems.sync="form.stiffening"
                            checkListName="stiffening">
                        </checkbox>
                        <span  class="text-xs italic text-error" v-if="form.errors.has('stiffening')"
                               v-text="form.errors.get('stiffening')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 id="condition" class="text-sm block mb-2">Condition</h3>
                        <checkbox
                            :items="conditionItems"
                            :checkedItems.sync="form.condition"
                            checkListName="condition">
                        </checkbox>
                        <span  class="text-xs italic text-error" v-if="form.errors.has('condition')"
                               v-text="form.errors.get('condition')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="mt-1 title flex justify-start items-left">
                            <h3 id="measurements" class="text-sm block mb-2 mr-2">Measurements</h3>
                            <span @mouseover="UpdateToolTipMsg(
                                    'Only fill out the fields of the table which make sense for your piece of clothing.\n' +
                                    'Measure the garment on the inside. Terms such as “Neck” and “Waist” mean the edge and waist seam of the garment, \n' +
                                     'not an estimate of where the wearer’s neck and waist would be. \n' +
                                      'For example in an empire line dress the “waist” would actually be measured at the underbust. \n'+
                                       'If there is a waistband take the bottom of the waistband as the “waist”.')"
                                  v-tooltip="{
                                  content: toolTipMsg,
                                  trigger: 'hover',
                                  placement: 'bottom-center',
                                  classes: ['info'],
                                  targetClasses: ['it-has-a-tooltip'],
                                  delay: {
                                    show: 100,
                                  },
                                }">Info
                            </span>
                        </div>
                            <Formtable
                                :items.sync="measurementTableItems"
                                labelTitle="Area being measured"
                                resultTitle="Inches"
                                tableName="measurements"
                                @recordTableInput="form.measurements = measurementTableItems">
                            </Formtable>
                        <span  class="text-xs italic text-error" v-if="form.errors.has('measurements')"
                               v-text="form.errors.get('measurements')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="mt-1 title flex justify-between items-center">
                            <label for="alterations" class="text-sm block mb-2">Alterations</label>
                            <span @mouseover="UpdateToolTipMsg('Can you see if the garment has been altered? .\n' +
                                    'Check for different types of thread, fabrics or trimmings that don’t quite match or look to be of a later date, \n' +
                                     'stitch holes where seams have been unpicked, or areas of hand sewing in an item that is mostly machine sewn (or vice versa).')"
                                  v-tooltip="{
                                  content: toolTipMsg,
                                  trigger: 'hover',
                                  placement: 'bottom-center',
                                  classes: ['info'],
                                  targetClasses: ['it-has-a-tooltip'],
                                  delay: {
                                    show: 100,
                                  },
                                }">Info
                            </span>
                        </div>
                        <textarea
                            id="alterations"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="2"
                            v-model="form.alterations">
                        </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('alterations')"
                              v-text="form.errors.get('alterations')">
                        </span>
                    </div>
                    <div class="mb-4">
                        <label for="provenance" class="text-sm block mb-2">Credit Line / Provenance</label>
                        <textarea
                            id="provenance"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            rows="2"
                            placeholder="Any information you have about the garments origins."
                            v-model="form.provenance">
                        </textarea>
                        <span class="text-xs italic text-error"
                              v-if="form.errors.has('provenance')"
                              v-text="form.errors.get('provenance')">
                        </span>
                    </div>
                    <h3 id="consent-heading" class="text-sm block mb-2">Consent - Would you mind if another member of the archive contacted you in regards to this garment?</h3>
                    <div class="mb-4">
                        <div class="wrapper-class mb-1" >
                            <input type="radio" id="yes" value="yes" v-model="form.consent" @click="form.errors.clear('consent',false)">
                            <label for="yes">Yes they can contact me</label>
                        </div>
                        <div class="wrapper-class mb-1">
                            <input type="radio" id="no" value="no" v-model="form.consent" @click="form.errors.clear('consent',false)">
                            <label for="no">No, I would rather they did not</label>
                        </div>
                        <span  class="text-xs italic text-error"
                               v-if="form.errors.has('consent')"
                               v-text="form.errors.get('consent')">
                        </span>
                    </div>
                    <div class="flex justify-end">
                            <a href="/article/" class="button is-outlined mr-2">Cancel</a>
                            <button v-if="CreateForm" class="button mr-2" :disabled="form.errors.any()">Create Article</button>
                            <button v-else-if="CreateForm === false && !admin" class="button mr-2" :disabled="form.errors.any()">Edit Article</button>
                            <button v-if="admin" class="button mr-2" :disabled="form.errors.any()">Make Live</button>
                    </div>
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
    import Formtable from "./reuse/Formtable";
    import moment from 'moment'
    import { ValidationProvider } from 'vee-validate';

    export default {
        name:'ArticleForm',
        components: {
            Datepicker,VTooltip,CountrySelector,Checkbox,Formtable,ValidationProvider
        },
        props: {
            article: Object,
            admin: Number,
            formType: String,
        }
        ,
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    earliest_date:'',
                    latest_date:'',
                    image_file_names:[],
                    physical_description: '',
                    designer:'',
                    search_words:'',
                    origin:'',
                    materials:'',
                    techniques:'',
                    decorations:'',
                    alterations:'',
                    sewing_methods:[],
                    classification:[],
                    cut:[],
                    fastenings:[],
                    stiffening:[],
                    measurements:[],
                    condition:[],
                    consent:'',
                    provenance:'',
                    status:'',
                    live:0,
                }),
                toolTipMsg: 'test',
                CreateForm: '',
                //object data
                sewing_methodsItems:[
                    { name:'hand sewn' , label:'Hand Sewn'},
                    { name:'machine sewn' , label:'Machine Sewn'},
                    { name:'knitted' , label:'Knitted'},
                    { name:'unknown' , label:'Unknown'}
                ],
                classificationItems:[
                    { name:'male' , label:'Male'},
                    { name:'female' , label:'Female'},
                    { name:'child' , label:'Child'},
                    { name:'baby' , label:'Baby'},
                    { name:'unknown' , label:'Unknown'}
                ],
                cutItems:[
                    { name:'straight' , label:'Straight'},
                    { name:'bias' , label:'Bias'},
                    { name:'stretch' , label:'Stretch'},
                    { name:'unknown' , label:'Unknown'}
                ],
                fasteningItems:[
                    { name:'hookeye' , label:'Hook and Eye/Bar'},
                    { name:'lacing' , label:'Lacing'},
                    { name:'drawstring' , label:'Drawstring'},
                    { name:'poppers' , label:'Poppers'},
                    { name:'press Studs' , label:'Press Studs'},
                    { name:'buttons' , label:'Buttons'},
                    { name:'zipper' , label:'Zipper'},
                    { name:'elastic' , label:'Elastic'},
                    { name:'other' , label:'Other'}
                ],
                stiffeningItems:[
                    { name:'whalebone' , label:'Whalebone'},
                    { name:'flat steel' , label:'Flat Steel Bone'},
                    { name:'spiral steel' , label:'Spiral Steel Bone'},
                    { name:'buckram' , label:'Buckram'},
                    { name:'padding' , label:'Padding'},
                    { name:'canvas' , label:'Canvas'},
                    { name:'petersham' , label:'Petersham'},
                    { name:'other' , label:'Other'}
                ],
                conditionItems:[
                    { name:'excellent' , label:'Excellent'},
                    { name:'good' , label:'Good'},
                    { name:'average' , label:'Average'},
                    { name:'poor' , label:'Poor'}
                ],
                consentItems:[
                    { name:'yes' , label:'Yes they can contact me'},
                    { name:'no' , label:'No, I would rather they did not'}
                ],
                measurementTableItems:[
                    { name:'bust' , label:'Bust (circumference of the inside, not laid flat)',  result: ""},
                    { name:'waist' , label:'Waist (circumference of the inside, not laid flat)', result:""},
                    { name:'hip' , label:'Hip (circumference of the inside, not laid flat)', result:""},
                    { name:'shoulder' , label:'Shoulder Seam', result:""},
                    { name:'across_front' , label:'Across the front (half way up the armhole, seam to seam)', result:""},
                    { name:'across_back' , label:'Across the back (half way up the armhole, seam to seam)', result:""},
                    { name:'cf_neck_waist' , label:'CF neck to waist', result:""},
                    { name:'cb_neck_waist' , label:'CB neck to waist', result:""},
                    { name:'under_arm_Waist' , label:'Underarm to side waist', result:""},
                    { name:'cf_waist_hem' , label:'CF waist to hem', result:""},
                    { name:'cb_waist_hem' , label:'CB waist to hem', result:""},
                    { name:'side_waist_hem' , label:'Side waist to hem', result:""},
                    { name:'circum_hem' , label:'Circumference of the hem (just one leg on trousers)', result:""},
                    { name:'armhole' , label:'Armhole', result:""},
                    { name:'sleeve_length' , label:'Sleeve length', result:""},
                    { name:'circum_wide_sleeve' , label:'Circumference of widest part of sleeve', result:""},
                    { name:'circum_narrow_sleeve' , label:'Circumference of narrowest part of sleeve', result:""},
                    { name:'cuff_depth' , label:'Cuff Depth', result:""},
                    { name:'lapel_width' , label:'Lapel Width', result:""},
                    { name:'circum_collar' , label:'Collar Circumference', result:""},
                ]
            };
        },
        methods: {
            UpdateToolTipMsg: function(formInput){
                this.toolTipMsg = formInput;
            },
            storeImagePath: function(ImageFileName)
            {
                var obj = JSON.parse(ImageFileName);
                this.form.image_file_names.push(obj.image_name);
            },
            ConvertToDate: function (date,format) {
                if (date){
                    return moment(date).format(format);
                }
                else
                {
                    return date
                }
            },
            ConvertToJson: function (obj){
                if (obj==="") {
                    return obj
                }
                else{
                    let json = JSON.stringify(obj);
                    return json;
                }
            },
            SetEditData: function(){
                this.CreateForm = false;
                Object.entries(this.form).forEach(([key, value]) => {
                    Object.entries(this.article).forEach(([articleKey, articleValue]) => {
                        if ([articleKey][0] === [key][0]){
                            if (Array.isArray(this.form[key]) && this.form[key] != "measurements")
                            {
                                var arr = [];

                                arr  = JSON.parse("[" + [articleValue] + "]");
                                for (var i = 0; i < arr.length; i++){
                                    for (var x = 0; x < arr[i].length; x++){
                                        this.form[key][x] = arr[i][x].toString();
                                    }
                                }
                                //this.form[key] = [articleValue];
                            }
                            else{
                                this.form[key] = String([articleValue]);
                            }
                        }
                    });
                });



                //measurement table assignment
                Object.entries(this.article).forEach(([articleKey, articleValue]) => {
                      if ([articleKey] == "measurements"){
                          var arr = [];
                          arr = JSON.parse("[" + this.article[articleKey] + "]");
                          arr = Object.setPrototypeOf(arr[0], Object.prototype);
                          //loop over measurement table
                          Object.entries(this.measurementTableItems).forEach(([measureTableKey, measureTableValue]) => {
                              //loop over measurement object from article
                              Object.entries(arr).forEach(([measureArray, measureValue]) => {
                                  if (measureTableValue["name"] === measureValue["name"]){
                                    this.measurementTableItems[measureTableKey]["result"] = measureValue["result"];
                                    }
                              });
                          });
                    }
                });
            },
            async Submit() {
                this.form.classification = this.ConvertToJson(this.form.classification);
                this.form.cut = this.ConvertToJson(this.form.cut);
                this.form.fastenings = this.ConvertToJson(this.form.fastenings);
                this.form.stiffening = this.ConvertToJson(this.form.stiffening);
                this.form.measurements = this.ConvertToJson(this.form.measurements);
                this.form.condition = this.ConvertToJson(this.form.condition);
                this.form.sewing_methods = this.ConvertToJson(this.form.sewing_methods);
                this.form.image_file_names = this.ConvertToJson(this.form.image_file_names);
                this.form.earliest_date = this.ConvertToDate(this.form.earliest_date,"YYYY-MM-DD");
                this.form.latest_date = this.ConvertToDate(this.form.latest_date,"YYYY-MM-DD");
                if (this.formType === "PATCH"){
                    this.form
                        .patch('/article' + '/' + this.article.id)
                        .then(window.location.href  = '/article' + '/' + this.article.id, response => alert(response.statusText))
                        .catch(error => console.log(error));
                }
                else{
                    this.form
                        .post('/article')
                        .then(article => location = article.message);
                }
            },
        },
        created(){
            if (this.formType === "PATCH"){
                this.SetEditData();
            }
            else{
                this.CreateForm = true;
            }
            if (this.admin == 1) {
                this.form.status = 'live';
                this.form.live = 1;
            }
            else if(!this.admin){
                this.form.status = 'pending';
                this.form.live = 0;
            }
        }
    }
</script>
<style scoped>
    .wrapper-class input[type="radio"] {
        width: 15px;
    }

    .wrapper-class label {
        display: inline;
        margin-left: 5px;
    }
</style>
