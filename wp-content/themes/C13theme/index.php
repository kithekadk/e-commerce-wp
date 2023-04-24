<?php get_header(); ?>

<?php
    if (have_posts()):
        while (have_posts()): the_post();?>

        <h3><?php the_title(); ?></h3>
        <small>Posted On <?php the_time('F j, Y') ?> at <?php the_time('g:i a') ?></small>
        <p><?php the_content(); ?></p>
        <small><?php the_category(); ?></small>
        <hr>
        
    <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>