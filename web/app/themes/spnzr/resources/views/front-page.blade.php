@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('pages.frontpage')
  @while(have_posts()) @php(the_post())
    @include('partials.content')
  @endwhile
@endsection
