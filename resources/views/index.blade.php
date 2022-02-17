@extends('layouts.mainwrap')

@php
    /**
    * @var \Illuminate\Support\Collection $categories
    * @var \App\Models\Page $page
    */
@endphp

@section('title')Новости @endsection

@section('main')
    <div class="row">
        <div class="col-12 pb-4">
            <div>Выберите категорию сайта:</div>
            <form class="row row-cols-sm-auto g-3 align-items-center">
                <div class="col-12">
                    {{ Form::select('category', $categories, $categoryId, ['class' => 'form-select']) }}
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @forelse($pages as $page)
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('page', [$page->id]) }}">
                                {{ $page->category->name }}
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $page->datetime_post->translatedFormat('j F Y H:i') }}
                        </h6>
                        <div class="card-text">
                            {{ $page->title }}
                        </div>
                        <a href="{{ route('page', [$page->id]) }}" class="card-link">
                            Полный текст новости
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    В этой категории новостей нет
                </div>
            </div>
        @endforelse
    </div>
@endsection
