@extends ('layouts.app')

@section('content')
    <header class="flex items-center mb-6 pb-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-default-color font-medium">
                    {{ $article->title }}
            </h2>
            <div class="flex items-center">
                @can ('manage', $article)
                    <a href="{{ $article->path().'/edit' }}" class="button ml-4">Edit Article</a>
                @endcan
            </div>
        </div>
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-5/6 px-3 mb-6">
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Estimated Date Range:
                        <P class="flex font-light ml-2"> {{ $article->earliest_date }} - {{ $article->latest_date }}</P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-medium mb-2">First Picture
                        <P class="flex font-light">GALLARY</P>
                    </h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-default-color font-bold mb-2">Description:</h3>
                    <p class="font-light">
                        {{ $article->description }}
                    </p>
                </div>
                <div class="mb-4 flex">
                    <div class="flex text-default-color font-bold">Maker/Designer:</div>
                    <div class="flex font-light ml-2">{{ $article->designer }}</div>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Place of Origin:
                        <P class="flex font-light ml-2"> {{ $article->origin }}</P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Materials:
                        <P class="flex font-light ml-2"> {{ $article->materials }}</P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Techniques:
                        <P class="flex font-light ml-2"> {{ $article->techniques }}</P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Trimmings/Decoration:
                        <P class="flex font-light ml-2"> {{ $article->decorations }}</P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Dress Themes:
                        <P class="flex font-light ml-2"> {{ $article->search_words }}</P>
                    </h3>
                </div>
                {{$article}}
            </div>
        </div>
    </main>
@endsection
