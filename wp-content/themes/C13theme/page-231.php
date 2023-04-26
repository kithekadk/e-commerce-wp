

<?php get_header(); ?>

    <?php if(have_posts()):
        while(have_posts()): the_post();   
    ?>
        <h3><?php the_title(); ?></h3>
        <p><?php the_content(); ?></p>
        <p><?php the_time(); ?></p>
    <?php endwhile; ?>
    <?php endif; ?>
<?php get_footer(); ?>