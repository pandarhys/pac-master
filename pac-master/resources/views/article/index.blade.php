@extends ('layouts.app')

@section('content')
    <header class="flex items-center mb-3 pb-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-muted text-base font-light">My Articles</h2>

            <a href="/article/create" class="button" @click.prevent="$modal.show('new-article')">New Article</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($articles as $article)
            <div class="lg:w-1/3 px-3 pb-6">
                @include ('article.card')
            </div>
        @empty
            <div>No articles yet.</div>
        @endforelse
    </main>

    <new-article-modal></new-article-modal>
@endsection
