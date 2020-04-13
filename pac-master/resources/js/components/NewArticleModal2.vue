<template>
    <modal name="new-article2" classes="p-10 bg-card rounded-lg" height="auto" width="full">
        <h1 class="font-normal mb-16 text-center text-2xl">Let’s Start Something New</h1>
            <ArticleForm @completed="ShowCreatedArticle"></ArticleForm>
    </modal>
</template>

<script>
    import ArticleForm from "./ArticleForm";

    export default {
        components: {ArticleForm},
        methods: {
            ShowCreatedArticle(Article){
                 window.location.href = Article.message;
            }
        }
    }
</script>
