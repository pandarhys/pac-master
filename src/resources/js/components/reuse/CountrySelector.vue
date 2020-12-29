<template>
    <v-select
        :options="paginated"
        :filterable="false"
        v-model="country"
        @open="onOpen"
        @close="onClose"
        @search="query => search = query"
    >
        <template #list-footer v-if="hasNextPage">
            <li ref="load" class="loader">
                Loading more options...
            </li>
        </template>
    </v-select>
</template>

<script>
    import countries from '../../data/countries';

    export default {
        name: "CountrySelector",
        props: ['countrySeleted'],
        data: () => ({
            observer: null,
            limit: 10,
            search: '',
            country: []
        }),
        mounted () {
            /**
             * You could do this directly in data(), but since these docs
             * are server side rendered, IntersectionObserver doesn't exist
             * in that environment, so we need to do it in mounted() instead.
             */
            this.observer = new IntersectionObserver(this.infiniteScroll);
            if (this.countrySeleted != ""){
                this.country = this.countrySeleted;
            }
        },
        computed: {
            filtered () {
                return countries.filter(country => country.includes(this.search));
            },
            paginated () {
                return this.filtered.slice(0, this.limit);
            },
            hasNextPage () {
                return this.paginated.length < this.filtered.length;
            },
        },
        methods: {
            async onOpen () {
                if (this.hasNextPage) {
                    await this.$nextTick();
                    this.observer.observe(this.$refs.load)
                }
            },
            onClose () {
                this.observer.disconnect()
                this.$emit('update:countrySeleted',this.country);
            },
            async infiniteScroll ([{isIntersecting, target}]) {
                if (isIntersecting) {
                    const ul = target.offsetParent;
                    const scrollTop = target.offsetParent.scrollTop;
                    this.limit += 10;
                    await this.$nextTick();
                    ul.scrollTop = scrollTop;
                }
            }
        }
    }
</script>

<style scoped>
    .loader {
        text-align: center;
        color: #bbbbbb;
    }
</style>
