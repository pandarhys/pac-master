<template>
    <div id="formTable">
            <table class="w-1/2 flex-wrap mb-1 border-muted-light border-2 border-gray-600 px-1 py-10">
                <tr class="flex justify-between">
                    <th class="ml-1 mb-1">Area being measured</th>
                    <th class="mr-5">Measurement (inches)</th>
                </tr>
                    <div v-for="item in items" :key="item.name">
                        <tr class="flex justify-between">
                            <td class="mt-2">
                                <label for="item.name" class="ml-1 mr-1 mb-1">{{ item.label }}</label>
                            </td>
                            <td>
                                <input v-model.number="item.result" type="number" :id="item.name" @change="onChange($event)" class="mr-1">
                            </td>
                        </tr>
                    </div>
             </table>
    </div>
</template>

<script>
    export default {
        name: "Formtable",
        props: ['items','tableName','tableItems'],
        data () {
            return {
                id:'',
            }
        },
        methods: {
            onChange(event) {
                this.$emit('update:formTableResults',this.tableItems);
            }
        }
    }
</script>

<style scoped>

</style>

