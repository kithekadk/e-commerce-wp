<h2>IMAGE POST FORMAT HERE</h2>
<h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
    <h4> <?php the_content() ?> </h4>
    <h3> <?php the_date(); ?> </h3>
<hr color="red">