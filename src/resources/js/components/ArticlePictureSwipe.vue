<template>
    <vue-picture-swipe :items="items"></vue-picture-swipe>
</template>
<script>
    import VuePictureSwipe from 'vue-picture-swipe';
    const BACKDROP_BASE = 'thumbnail/';
    export default {
        name: "ArticlePictureSwipe",
        components: { VuePictureSwipe },
        props: {
            images: Array,
        },
        data() {
            return {
                 items: [{
                     src: 'http://via.placeholder.com/600x400',
                     thumbnail: 'http://via.placeholder.com/64x64',
                        w: 600,
                        h: 400
                    },
                     {
                         src: 'http://via.placeholder.com/1200x900',
                         thumbnail: 'http://via.placeholder.com/64x64',
                         w: 1200,
                         h: 900
                     }
                 ],
                images: '',
                src: '',
                w:'',
                h:''
             };
        },
        methods: {
            ImageObject(src,thumbnail,w,h) {
                this.src = src;
                this.thumbnail = thumbnail;
                this.w = w;
                this.h = h;
            }
        },
        mounted() {
            console.log(this.images);
            var arr = [];
            var itemArray = [];
            arr = JSON.parse("[" + [this.images] + "]");
            for (var i = 0; i < 1; i++) {
                for (var x = 0; x < 1; x++) {
                    itemArray.push( new ImageObject(BACKDROP_BASE + arr[i][x].split('"').join(''),BACKDROP_BASE + arr[i][x].split('"').join(''),600,400))
                    // this.items.src = BACKDROP_BASE + arr[i][x].split('"').join('');
                    // this.items.thumbnail = BACKDROP_BASE + arr[i][x].split('"').join('');
                    // this.items.w = 600;
                    // this.items.h = 400;
                }
            }
            this.items = itemArray;
        }
    }
</script>
