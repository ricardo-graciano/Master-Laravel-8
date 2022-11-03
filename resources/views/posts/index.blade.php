@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
{{-- @each('posts.partials.post', $posts, 'post') --}}
<div class="row">
  <div class="col col-8">
    @forelse ($posts as $key => $post)
      @include('posts.partials.post', [])
    @empty
      No blog posts yet!
    @endforelse
  </div>
  <div class="col col-4">
    <div class="container">
      <div class="row">
        @card([
          'title' => 'Most Commented',
          'subtitle' => 'What people are talking about',
        ])
          @slot('items')
            @foreach ($mostCommented as $post)  
              <li class="list-group-item">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                  {{ $post->title }}
                </a>
              </li>
            @endforeach
          @endslot
        @endcard
      </div>
      <div class="row mt-4">
        @card([
          'title' => 'Most Active',
          'subtitle' => 'Users with most posts written',
          'items' => collect($mostActive)->pluck('name')
        ])
        @endcard
      </div>
      <div class="row mt-4">
        @card([
          'title' => 'Most Active Last Month',
          'subtitle' => 'Users with most posts written in last month',
          'items' => collect($mostActiveLastMonth)->pluck('name')
        ])
        @endcard
      </div>

    </div>
  </div>
</div>

@endsection