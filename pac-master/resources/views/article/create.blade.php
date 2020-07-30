@extends ('layouts.app')

@section('content')
    <div class="lg:w-full lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow w-full">
        <article-form :form-type="'POST'" :admin="{{ Auth::user()->admin }} "></article-form>
    </div>
@endsection
