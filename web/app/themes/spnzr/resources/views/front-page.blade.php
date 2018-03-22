@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('pages.frontpage')
    @include('partials.content-page')
  @endwhile
@endsection
