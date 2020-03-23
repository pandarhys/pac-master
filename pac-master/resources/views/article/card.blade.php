<div class="card flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-accent-light pl-4">
        <a href="{{ $article->path() }}" class="text-default no-underline">{{ $article->title }}</a>
    </h3>

    <div class="mb-4 flex-1">{{ str_limit($article->description, 100) }}</div>

    @can ('manage', $article)
        <footer>
            <form method="POST" action="{{ $article->path() }}" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs">Delete</button>
            </form>
        </footer>
    @endcan
</div>
