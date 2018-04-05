<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="wrap" role="document">
      <main class="main content">
        @yield('content')
      </main>
      @if (App\display_sidebar())
        <aside class="sidebar">
        </aside>
      @endif
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
