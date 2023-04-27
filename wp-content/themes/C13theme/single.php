<?php get_header();?>

    <?php 
        if(have_posts()):
            while(have_posts()): the_post();
    ?>
    <header> 
            <h2><?php the_title();  if(current_user_can('manage_options')){ echo ' || '; edit_post_link();} ?></h2>
            <?php the_content(); ?>
    <header>
    <?php 
        endwhile;
        endif;
    ?>

    <!-- ACTIVATING COMMENTS -->
    <?php 
        if(comments_open()){
            comments_template();
        }
    ?>

    <!-- Pagination to posts -->
    <div>
        <?php previous_post_link();?> &nbsp; <?php next_post_link()?>
    </div>
<?php get_footer();?>