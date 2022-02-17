@extends('layouts.mainwrap')

@php
  /**
  * @var \App\Models\Page $page
  */
@endphp

@section('title'){{ $page->title }} - новость на сайте @endsection

@section('main')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <small>
            {{ $page->category->name }}
          </small>
          <h5 class="card-title">
            {{ $page->title }}
          </h5>
          <h6 class="card-subtitle mb-2 text-muted">
            {{ $page->datetime_post->translatedFormat('j F Y H:i') }}
          </h6>
          <div class="card-text">
            {!! $page->text !!}
          </div>
          <div class="row pt-2">
            <div class="col-12 col-sm-auto">
              <a href="{{ route('index') }}?category={{ $page->category->id }}" class="card-link">
                Все новости этой категории
              </a>
            </div>
            <div class="col-12 col-sm-auto">
              <a href="{{ route('index') }}" class="card-link">
                Полный список новостей
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
