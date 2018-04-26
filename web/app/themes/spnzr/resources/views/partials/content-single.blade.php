<article id={{get_post_field( 'post_name', get_post() )}} @php(spnzr_the_classes('post')) @php(the_bg_image())>

	<header class="c entry-header">
		<h1 class="entry-title">{!! get_the_title() !!} <span class="slashes">///</span></h1>
		<p class="entry-meta">
			{!! get_field("sub-heading") !!}
			<br>
			<i>{{ get_the_date("F Y") }}</i>
		</p>
  </header>
  
	<div class="cc entry-content">
		@php(the_content())
	</div>

	<footer class="content-info">

		<div class="c entry-footer">
			<h5>meta ///</h5>
			<p>
				tags::: @php( the_tags(''))
			</p>
			@php( credibility_footnotes_display())
		</div>
  </footer>

</article>
<div @php(spnzr_the_classes('palm'))>
	<nav role="navigation" class="nav c">

		<div class="mr-auto">
			<div class="d-flex">
				<a class="" class="h4" href="/"><i class="fa fa-home"></i> home</a>
				<a class="" href="/about-spencer-mccormick"><i class="fa fa-user"></i> about spencer</a>
				<a class="" href="mailto:spnzrr@gmail.com"><i class="fa fa-envelope"></i> email me, please?</a>
			</div>
			<div class="d-flex">
				<a href="/terms/#copyright">© spencer <?php echo date('Y') ?></a><em>//</em><a href="/terms" class="">terms</a><em>//</em><a href="/terms/#privacy" class="">privacy</a>
			</div>
			</div>
		<div class="ml-auto">
			<div class="social-links">
				<a class="btn-share-facebook social-link" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());?>" onClick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]=<?php the_title(); ?>&p[url]=<?= esc_url(get_permalink()); ?>','sharer','toolbar=0,status=0,width=580,height=325'); event.preventDefault();"><i class="fa fa-facebook"></i></a>
				<a class="btn-share-twitter social-link" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo esc_url(get_permalink());?>" onClick="window.open('https://twitter.com/intent/tweet?text=<?= esc_url(get_permalink()); ?>','sharer','toolbar=0,status=0,width=580,height=325'); event.preventDefault();"><i class="fa fa-twitter"></i></a>
				<a class="btn-share-print social-link" target="_blank" href="javascript:window.print()"><i class="fa fa-print"></i></a> 
				<a class="btn-share-email social-link" target="_blank" href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>"><i class="fa fa-envelope"></i></a>
			</div>
			<div class="permalink"><i class="fa fa-link"></i><input type="text" name="shortURL" readonly class="shorturl" value="{{get_permalink()}}"></div>
		</div>
	</nav>
</div>
