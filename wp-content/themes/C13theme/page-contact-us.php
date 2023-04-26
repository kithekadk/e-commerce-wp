<?php get_header(); ?>

    <?php 
        if(have_posts()):
            while(have_posts()): the_post();
    ?>
    <h3 style="color:red;"><?php the_title(); ?></h3>
    <p><?php the_content(); ?></p>

    <?php endwhile; ?>
    <?php endif; ?>


<?php get_footer(); ?>