<h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>

<div><?php the_post_thumbnail('thumbnail'); ?></div>
<small>Posted On <?php the_time('F j, Y') ?> at <?php the_time('g:i a') ?></small>
<p><?php the_content(); ?></p>
<small><?php the_category(); ?></small>
<hr>