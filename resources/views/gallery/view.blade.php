@extends('layouts.appHome')
@section('content')
<div class=" py-5">
    <div class="container">
        <h1 class="mb-4 text-center mb-3">Album <span class="text-primary text-uppercase">{{ $images[0]->name }}</span></h1>
        <p class="mb-4 text-center">
            {{ $images[0]->content }}
        </p>
        <div class="row g-4">
            <div class="gallery">
                @foreach($images as $key=>$gallery)
                <article style="--bg-img:url({{ Storage::url($gallery->url) }})">
                  <button type="button" aria-label="open Pakistan Kissan Rabta Committee">
                    <img src="{{ Storage::url($gallery->url) }}" alt="Pakistan Kissan Rabta Committee">
                  </button>
                  <div>
                    <h2>{{ $gallery->title }}</h2>
                    <p>{{ $gallery->description }}</p>
                    <!--<a href="https://www.linkedin.com/in/chrisbolson/" target="_blank">Linkedin</a>-->
                    <button type="button" data-close="" aria-label="close Pakistan Kissan Rabta Committee" tabindex="-1">&#10005;</button>
                  </div>
                </article>
                @endforeach
              </div>
        </div>
    </div>
</div>
@endsection
