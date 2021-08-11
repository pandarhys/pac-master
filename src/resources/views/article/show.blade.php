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
                    <h3 class="flex text-default-color font-medium mb-2">
                        <article-picture-swipe :images="[ {{  $article->image_file_names }} ]"><article-picture-swipe>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-medium mb-2">
                        <vue-picture-swipe :items="[
    {src: 'http://127.0.0.1/images/162774862015989778832018-07-29 18.48.33.jpg',thumbnail: 'http://127.0.0.1/thumbnail/162774862015989778832018-07-29 18.48.33.jpg',w: 600,h: 400, title: 'Will be used for caption'},
    {src: 'http://127.0.0.1/images/162774862015989778832018-07-29 18.48.33.jpg',thumbnail: 'http://127.0.0.1/thumbnail/162774862015989778832018-07-29 18.48.33.jpg',w: 1200,h: 900}]"><vue-picture-swipe>
                    </h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-default-color font-bold mb-2">Description:</h3>
                    <p class="font-light">
                        {{ $article->description }}
                    </p>
                </div>
                <div class="mb-4 flex">
                    <h3 class="text-default-color font-bold mb-2">Maker/Designer:</h3>
                    <p class="font-light">
                        {{ $article->designer }}
                    </p>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Place of Origin:
                        <P class="flex font-light ml-2">
                            {{ $article->origin }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Materials:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->materials) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Techniques:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->techniques) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Trimmings/Decoration:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->decorations) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Dress Themes:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->search_words) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Method:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->sewing_methods) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Classification:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->classification) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Cut:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->cut) }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Fastenings:
                        <P class="flex font-light ml-2">
                            {{ ucwords($article->fastenings) }}

                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Stiffening:
                        <P class="flex font-light ml-2">
                            {{ $article->stiffening }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Alterations:
                        <P class="flex font-light ml-2">
                            {{ $article->alterations }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Condition:
                        <P class="flex font-light ml-2">
                            {{ $article->condition }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                    <h3 class="flex text-default-color font-bold">Provenance:
                        <P class="flex font-light ml-2">
                            {{ $article->provenance }}
                        </P>
                    </h3>
                </div>
                <div class="mb-4 flex">
                        <table class="rounded-t-lg ml-0 m-5 w-5/6 bg-gray-800 text-gray-200">
                            <tr class="text-left border-b border-gray-300">
                                <th class="px-4 py-3">Measurements</th>
                                <th class="px-4 py-3">Inches</th>
                            </tr>
                            @foreach (json_decode(json_encode($article->measurements,true),true) as $item)
                                @if ( !$item['result']== "")
                                <tr class="bg-gray-700 border-b border-gray-600">
                                    <td class="px-4 py-3">{{$item['label']}}</td>
                                    <td class="px-4 py-3">{{$item['result']}}</td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                </div>


            </div>
        </div>
    </main>
@endsection
