@php
if (post_password_required()) {
  return;
}
@endphp

      <section id="comments" class="comments">
        <h4>Insightful Commentary 😉</h4>
        <div class="fb-comments chicken" data-href="{{ get_permalink() }}">
        </div>
      </section>
