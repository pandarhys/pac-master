<template>
        <div id="uploader">
            <vue-dropzone id="upload" :options="config" :placeholderMsg="DefaultMsg"  @vdropzone-complete="afterComplete"></vue-dropzone>
        </div>
</template>

<script>
    import vueDropzone from "vue2-dropzone";

    export default {
        props:['placeholderMsg'],
        data: () => ({
            config: {
                url: "http://127.0.0.1:8000/api/image",
                dictDefaultMessage: "test"
            },
            DefaultMsg: "Default Message"
        }),
        components: {
            vueDropzone
        },
        methods: {
            afterComplete(file) {
                console.log(file);
            }
        },
        mounted() {
           this.config.dictDefaultMessage = 'placeholderMsg';
        }
    };
</script>
