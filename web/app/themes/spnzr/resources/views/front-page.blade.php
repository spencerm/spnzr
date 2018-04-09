@extends('layouts.front')

@section('content')
  @include('pages.frontpage')
  @while(have_posts()) @php(the_post())
    @include('partials.content-single')
  @endwhile
@endsection
