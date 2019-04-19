@extends('errors.illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('button')
    <a href="{{ route('test.exams')}}">
        <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
            {{ __('Go Tests') }}
        </button>
    </a>
@endsection
@section('image')
    <img src='{{asset('img/unauthorized.jpg')}}'/>
@endsection
