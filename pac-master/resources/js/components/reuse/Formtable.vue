<template>
    <div id="formTable">
            <table class="flex-wrap mb-1 border-muted-light border-2 border-gray-600 px-1 py-10">
                <tr class="flex justify-between mx-auto">
                    <th class="ml-1 mb-1 w-3/4 text-left mt-1">{{ labelTitle }}</th>
                    <th class="mr-1 mb-1 w-1/4 mt-1">{{ resultTitle }}</th>
                </tr>
                    <tr v-for="item in items" :key="item.name" class="flex justify-between">
                        <td class="w-3/4">
                            <label for="item.name" class="ml-1">{{ item.label }}</label>
                        </td>
                        <td class="w-1/4">
                            <input v-model.number="item.result" type="number" min="0" :id="item.name" @change="onChange($event)" class="h-full">
                        </td>
                    </tr>
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
            this.$emit('recordTableInput',this.items);
        }
    }
</script>

<style scoped>

</style>

