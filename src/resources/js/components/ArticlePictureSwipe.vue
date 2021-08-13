<template>
    <vue-picture-swipe :items="items"></vue-picture-swipe>
</template>
<script>
    import VuePictureSwipe from 'vue-picture-swipe';
    export default {
        name: "ArticlePictureSwipe",
        components: { VuePictureSwipe },
        props: {
            images: Array,
        },
        data() {
            return {
                 items: [
                     {
                         src: '',
                         thumbnail: '',
                         w: 1200,
                         h: 900,
                     }
                 ],
             };
        },
        mounted() {
            var arr = [];
            var itemArray = [];
            arr = this.images;
            for (var i = 0; i < arr.length; i++) {
                var obj = {};
                obj.src = 'http://127.0.0.1/images/' + arr[i];
                obj.thumbnail = 'http://127.0.0.1/thumbnail/' + arr[i];
                obj.w = 1200;
                obj.h = 900;
                itemArray.push(obj);
            }
            this.items = itemArray;
        }
    }
</script>
