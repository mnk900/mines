@extends('layouts.appHome')
@push('styles')
<style>
/* Variable */
body {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
  background: #efefef;
  font-size: 14px;
}
.gallery {
  display: flex;
  flex-flow: row wrap;
  max-width: 1140px;
  height: 100%;
  margin: 0 auto;
  align-items: flex-start;
  justify-content: space-between;
  padding: 20px 10px;
}
.thumbnail {
  display: flex;
  height: 33vh;
  max-height: 180px;
  min-width: 200px;
  max-width: 25%;
  cursor: pointer;
  border: 1px dotted #e4e4e4;
  flex-basis: 18%;
  margin-bottom: 30px;
  align-content: center;
  align-items: center;
  justify-content: center;
  flex-flow: column nowrap;
  text-align: center;
  color: #ccc;
  font-weight: 300;
  font-size: 1em;
  transition: background 500ms linear;
}
.thumbnail .title {
  margin-top: auto;
  padding: 0 0 20px 0;
  color:black;
}
.folder {
  position: relative;
  height: 40%;
  width: 55%;
  margin-top: auto;
  background: #dc261d;
  border-radius: 0 4px 0 0;
}
.folder,
.folder:before {
  transition: background 150ms cubic-bezier(0.445, 0.05, 0.55, 0.95) 150ms;
}
.folder:after,
.folder:before {
  content: '';
  display: block;
  width: 100%;
  height: 100%;
}
.folder:after {
  transform: scaleY(1) skewX(-2deg);
  border-radius: 4px 4px 0 0;
  transform-origin: bottom left;
  background: #dc261d;
  transition: all 150ms cubic-bezier(0.445, 0.05, 0.55, 0.95) 150ms;
}
.folder:before {
  position: absolute;
  top: 0;
  left: 0;
  transform: translateY(-50%);
  height: 10px;
  width: 30%;
  background: #dc261d;
  border-radius: 2px 6px 0 0;
}
.folder .file {
  transform: scale(0.93, 0.94) skewX(-2deg) translate(-2px, 0);
}
.folder .file,
.folder .file:after,
.folder .file:before {
  position: absolute;
  bottom: 0;
  left: 0;
  display: block;
  width: 100%;
  height: 100%;
  background: #fff;
  box-shadow: -1px -1px 1px rgba(255,58,22,0.3);
}
.folder .file:before {
  content: '';
  transform: scale(1, 0.95) skewX(-3deg) translate(1px, 0);
  transition: all 250ms cubic-bezier(0.77, 0, 0.175, 1) 250ms;
}
.folder .file:after {
  content: '';
  transform: scale(1, 0.88) skewX(-4deg) translate(3px, 0);
}
.thumbnail:hover {
  border: 1px dotted #ddd;
}
.thumbnail:hover .folder,
.thumbnail:hover .folder:before {
  background: #dc261d;
}
.thumbnail:hover .folder:after {
  transform: scaleY(0.9) skewX(-6deg);
  background: #dc261d;
}
.thumbnail:hover .folder .file:before {
  transform: scale(1, 0.95) skewX(-4deg) translate(15px, -30%) rotate(25deg);
  box-shadow: -1px 1px 1px rgba(255,58,22,0.3);
}
</style>
@endpush
@section('content')
<div class=" py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <h1 class="mb-4 text-center">Our <span class="text-primary text-uppercase">Gallery</span></h1>
                <p class="mb-4 mt-1">PKRC's gallery highlights efforts to empower local farmers and promote sustainable agriculture. It features images and stories of land redistribution, sustainable farming practices, and community-driven projects, showcasing the impact of collective action on improving food security and socio-economic conditions for smallholder farmers in Pakistan.
                </p>
            <div class="gallery">
                @foreach ($gallery_images as $key=>$gallery)
                <a href="{{ route('gallery.view',['id'=>$gallery[0]['gallery_id']]) }}">
                <div class="thumbnail"><span class="folder"><span class="file"></span></span>
                    <div class="title text-info">{{ $gallery[0]['name'] }}</div>
                </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

