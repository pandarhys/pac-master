@extends ('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Edit Your Article
        </h1>

        <form
                method="POST"
                action="{{ $article->path() }}"
        >
            @method('PATCH')

            @include ('article.form', [
                'buttonText' => 'Update Article'
            ])
        </form>
    </div>
@endsection
