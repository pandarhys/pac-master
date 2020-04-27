<template>
    <div id="checkbox" class="flex justify-start items-start">
        <div class="flex justify-start items-start" v-for="item in items" :key="item.name">
            <input type="checkbox" :id="item.name" :value="item.name" v-model="checkedNames" @change="onChange($event)" class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-1 focus-within:border-blue-500">
            <label for="item.name" class="mr-1">{{ item.label }}</label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CheckBox",
        props: ['items','checkListName','checkedItems'],
        data () {
            return {
                id:'',
                value:'',
                checkedNames: [],

            }
        },
        methods: {
            onChange(event) {
                this.$emit('update:checkedItems',this.checkedNames);
            }
        }
    }
</script>

<style scoped>

</style>

