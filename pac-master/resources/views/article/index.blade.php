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
{{--                            <div>--}}
{{--                                <form method="POST" action="{{ $article->path() }}" class="text-right">--}}
{{--                                    @method('DELETE')--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="text-xs">Delete</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--            <div class="lg:w-1/8  px-1 pb-3">--}}
            <div class="h-150 w-150  px-1 pb-3">
                <article-card :article="{{ $article }}" article-url="{{ $article->path() }}"><article-card>
            </div>
        @empty
            <div>No articles yet.</div>
        @endforelse
    </main>
@endsection
