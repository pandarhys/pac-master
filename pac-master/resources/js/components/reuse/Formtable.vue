<template>
    <div id="formTable">
            <table class="flex-wrap mb-1 border-muted-light border-2 border-gray-600 px-1 py-10">
                <tr class="flex justify-between">
                    <th class="ml-1 mb-1">{{ labelTitle }}</th>
                    <th class="mr-5">{{ resultTitle }}</th>
                </tr>
                    <div v-for="item in items" :key="item.name">
                        <tr class="flex justify-between">
                            <td class="mt-2">
                                <label for="item.name" class="ml-1 mr-1 mb-1">{{ item.label }}</label>
                            </td>
                            <td>
                                <input v-model.number="item.result" type="number" min="0" :id="item.name" @change="onChange($event)" class="mr-1">
                            </td>
                        </tr>
                    </div>
             </table>
    </div>
</template>

<script>
    export default {
        name: "Formtable",
        props: ['items','tableName','tableItems','labelTitle','resultTitle'],
        data () {
            return {
                id:'',
            }
        },
        methods: {
            onChange(event) {
                this.$emit('recordTableInput',this.items);
            }
        },
        created(){

            //
            // if (this.checkedItems !== ""){
            //     var arr = [];
            //     arr  = JSON.parse("[" + this.checkedItems + "]");
            //     for (var i = 0; i < arr.length; i++){
            //         this.checkedNames[i] = arr[i].toString();
            //     }
            // }
        }
    }
</script>

<style scoped>

</style>

