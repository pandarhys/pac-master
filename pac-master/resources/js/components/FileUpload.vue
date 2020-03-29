<template>
    <div id="app">
        <div id="uploader">
            <vue-dropzone id="upload" :options="config"  @vdropzone-complete="afterComplete"></vue-dropzone>
        </div>
    </div>
</template>

<script>
    import vueDropzone from "vue2-dropzone";

    export default {
        data: () => ({
            config: {
                url: "http://127.0.0.1:8000/api/image"
            }
        }),
        components: {
            vueDropzone
        },
        methods: {
            afterComplete(file) {
                console.log(file);
            }
        }
    };
</script>
