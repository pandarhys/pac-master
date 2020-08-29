@extends ('layouts.app')

@section('content')
    <div class="mx-auto bg-card p-6 rounded shadow">
        <article-form :form-type="'POST'" :admin="{{ Auth::user()->admin }} "></article-form>
    </div>
@endsection
