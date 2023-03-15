@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <h2 class="text-center mb-5">Add project</h2>
            @include('includes.projects.form')
        </div>
    </main>
@endsection
