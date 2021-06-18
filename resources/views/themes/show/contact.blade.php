@extends('themes.app')
@section('title')
{{ $contact->title }}
@endsection
@section('description')
{{ $contact->description }}
@endsection
@section('keywords')
{{ $contact->keywords }}
@endsection
@section('container')

    <main>
        <div class="index--contact__head" style="background-image: url({{ $contact->image }})">
            <h3 class="contact__header">
                {{ $contact->header }}
            </h3>
            <div class="container">
                <div class="contact__text">
                    {!! $contact->text !!}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="mt-2 p-2">
                {!! $contact->content !!}
            </div>
        </div>
    </main>
@endsection
@push('css')
<style>
    header{
        position: relative !important;
    }
</style>
@endpush