<?php get_header(); ?>

<?php
    if (have_posts()):
        while (have_posts()): the_post() ;?>

        <?php // require 'content.php' ?>
        <?php get_template_part('content', get_post_format()) ?>
        
    <?php endwhile; ?>
<?php endif; ?>

<h1 class="mysidebar">
    <?php get_sidebar(); ?>
</h1>

<?php get_footer(); ?>