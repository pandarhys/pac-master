@extends ('layouts.app')

@section('content')
    <header class="flex items-center mb-3 pb-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-muted text-base font-light">Articles</h2>
            <a href="/article/create" class="button">New Article</a>
        </div>
    </header>
    <main class="lg:flex lg:flex-wrap -mx-1">
        @forelse ($articles as $article)
            <div class="lg:w-1/5 px-1 pb-3">
                <article-card :article="{{ $article }}"><article-card>
            </div>
        @empty
            <div>No articles yet.</div>
        @endforelse
    </main>
@endsection
