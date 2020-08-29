<template>
        <div class="w-150 h-150 card border-0 px-1 py-1">
            <img class="rounded-lg" v-bind:src="this.displayImage"/>
            <h3 class="text-center">
                <a :href="this.articleUrl" class="text-center text-sm no-underline p-1 overflow-hidden">
                {{ trimmedTitle }}
                </a>
            </h3>
        </div>
</template>

<script>
    const BACKDROP_BASE = 'thumbnail/';
    export default {
        name: "ArticleCard",
        props: {
            article: Object,
            articleUrl: String,
        },
        data () {
            return {
                displayImage: String,
                trimmedTitled: String
            }
        },
        computed: {
            trimmedTitle: function(){
                var string = this.article.title;
                var length = 12;
                var trimmedString = string.length > length ?
                    string.substring(0, length - 3) + "..." :
                    string;
                return  trimmedString;
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

