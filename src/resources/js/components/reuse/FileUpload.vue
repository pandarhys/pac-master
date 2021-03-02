    <template>
            <div id="uploader">
                <vue-dropzone id="upload" :options="config" @vdropzone-complete="afterComplete"></vue-dropzone>
            </div>
    </template>

    <script>
        import vueDropzone from "vue2-dropzone";

        export default {
            props: ['message'],
            data: () => ({
                config: {
                    url: "http://127.0.0.1/api/image",
                    dictDefaultMessage: ""
                },
            }),
            components: {
                vueDropzone
            },
            methods: {
                afterComplete(file) {
                    console.log(file.xhr.response);
                    this.$emit('storeFileName',file.xhr.response)
                }
            },
            created(){
                 this.config.dictDefaultMessage = this.message;
            }
        };
    </script>
