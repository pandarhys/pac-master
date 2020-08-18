<template>
    <div class="card flex flex-col" style="height: 150px">
        <img v-bind:src="this.displayImage" width="card flex flex-col" style="height: 140px"/>
        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-accent-light pl-4">
<!--            <a href="{{ $article->path() }}" class="text-default no-underline">{{ $article->title }}</a>-->
        </h3>
<!--        <div class="mb-4 flex-1">{{ str_limit($article->description, 100) }}</div>-->
    </div>

</template>

<script>
    const BACKDROP_BASE = 'images/';
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
                    'background-repeat': 'no-repeat',
                    'background-size': 'cover'
                }
            }
        },
        methods: {
            onChange(event) {
            }
        },
        mounted(){
                var arr = [];
                arr  = JSON.parse("[" + [this.article.image_file_names] + "]");
                for (var i = 0; i < 1; i++){
                    for (var x = 0; x < 1; x++){
                        this.displayImage = BACKDROP_BASE + arr[i][x].toString();
                        console.log(this.displayImage);
                    }
                }
        }
    }
</script>

<style scoped>

</style>

