<template>
    <div>
        <viewer ref="viewer" :options="options" class="viewer" :images="images">
            <template v-for="(image,index) in images">
                <img
                    :src="image.thumbnail" class="image" :key="index"
                    :data-src="image.source"
                >
            </template>
        </viewer>
    </div>
</template>
<script>

import 'viewerjs/dist/viewer.css'
import { component as Viewer } from "v-viewer"
const sourceImages = []

export default {
    components: {
        Viewer
    },
    props: {
        items: Array,
    },
    methods: {
        toggle() {
        }

    },
    data() {
        return {
            options: {
                url: 'data-src'
            },
            images: sourceImages
        };
    },
    mounted() {
        var arr = [];
        var itemArray = [];
        arr = this.items;
        for (var i = 0; i < arr.length; i++) {
            sourceImages.push({
                thumbnail: 'http://127.0.0.1/thumbnail/' + arr[i],
                source: 'http://127.0.0.1/images/' + arr[i]
            })
        }
    },
}
// {src: 'http://127.0.0.1/images/162774862015989778832018-07-29 18.48.33.jpg',
</script>
