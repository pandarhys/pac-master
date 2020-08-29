<template>
        <div class="card flex flex-col border-0 px-1 py-1">
            <img class="rounded-lg" v-bind:src="this.displayImage"/>
        </div>
</template>

<script>
    const BACKDROP_BASE = 'thumbnail/';
    export default {
        name: "ArticleCard",
        props: {
            article: Object,
        },
        data () {
            return {
                displayImage: String
            }
        },
        computed: {
            styles() {
                return {
                    'background-image': this.displayImage,

                }
            },
            img_section_style: function(){
                    var bgImg= this.displayImage;
                    return {
                        'background': 'url('+bgImg+')',
                        'background-repeat': 'no-repeat',
                        'background-size': 'cover',
                        'width': '145px',
                        'height': '145px',

                    }
            },
        },
        methods: {
            onChange(event) {
            }
        },
        mounted() {
            var arr = [];
            arr  = JSON.parse("[" + [this.article.image_file_names] + "]");
            for (var i = 0; i < 1; i++){
                for (var x = 0; x < 1; x++){
                    this.displayImage = BACKDROP_BASE + arr[i][x].split('"').join('');
                    console.log(this.displayImage);
                }
            }
        }
    }
</script>

<style scoped>
    .bgimg {
        object-fit: cover;
    }
</style>

