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
                src: '',
                thumbnail:'',
                w:'',
                h:'',

             };
        },
        mounted() {
            var arr = [];
            var itemArray = [];
            var obj = {};
            arr = this.images;
            // console.log(this.images);
            for (var i = 0; i < arr.length; i++) {
                obj.src = arr[i]
                obj.thumbnail = BACKDROP_BASE + arr[i]
                obj.w = 600
                obj.h = 400
                itemArray.push(obj)
            }
            this.items = itemArray;
            console.log(this.items);
        }
    }
</script>
