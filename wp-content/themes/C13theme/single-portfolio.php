<?php get_header();?>

    <?php 
        if(have_posts()):
            while(have_posts()): the_post();
    ?>
    <header> 
            

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title();  if(current_user_can('manage_options')){ echo ' || '; edit_post_link();} ?></h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <p class="card-text"><?php the_content(); ?></p>
                    <h6 href="#" class="card-link"><?php previous_post_link();?></h6>
                    <h6 href="#" class="card-link"> <?php next_post_link() ?></h6>
                </div>
            </div>
    <header>
    <?php 
        endwhile;
        endif;
    ?>

<?php get_footer();?>