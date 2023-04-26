<?php get_header(); 

/**
* Template Name: Page View Post With WP Query
*
*/
?>
    <!-- GEtting posts -->
    <?php 
        $blogs = new WP_Query('type=post&posts_per_page=3');

        
        if ($blogs->have_posts()):
            while($blogs->have_posts()):$blogs->the_post();?>
            <header>
            <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
            </header>

            <p><?php the_content(); ?></p>
            
            <?php
            endwhile;
        endif;
        wp_reset_postdata();
    ?>
    <!-- GEtting posts and using offset-->
    <hr color="red">
    <?php 
        $blogs = new WP_Query('type=post&posts_per_page=4&offset=2');

        
        if ($blogs->have_posts()):
            while($blogs->have_posts()):$blogs->the_post();?>
            <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
            <p><?php the_content(); ?></p>

            <?php
            endwhile;
        endif;
        wp_reset_postdata();
    ?>

    <!-- GEtting posts and filtering by category ID-->
    <hr color="red">
    <?php 
        $blogs = new WP_Query('type=post&posts_per_page=-1&cat=69');

        
        if ($blogs->have_posts()):
            while($blogs->have_posts()):$blogs->the_post();?>
            <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
            <p><?php the_content(); ?></p>

            <?php
            endwhile;
        endif;
        wp_reset_postdata();
    ?>

    <!-- GEtting posts and filtering by category Name-->
    <hr color="red">
    <?php 
        $blogs = new WP_Query('type=post&posts_per_page=-1&category_name=other');
        
        if ($blogs->have_posts()):
            while($blogs->have_posts()):$blogs->the_post();?>
            <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
            <p><?php the_content(); ?></p>

            <?php
            endwhile;
        endif;
        wp_reset_postdata();
    ?>

    <!-- GEtting posts and filtering by category Name-->
    <hr color="red">
    <?php 
        $args = [
            'type'=>'post',
            'posts_per_page'=>-1,
            'category_name'=>'other'
        ];
        $blogs = new WP_Query($args);
        
        if ($blogs->have_posts()):
            while($blogs->have_posts()):$blogs->the_post();?>
            <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
            <p><?php the_content(); ?></p>

            <?php
            endwhile;
        endif;
        wp_reset_postdata();
    ?>

    <!-- GEtting posts and filtering by category to View-->
    <hr color="red">
    <?php 
        $args_cat = [
            'include'=>'72, 69, 70'
        ];

        $categories = get_categories($args_cat);

        foreach($categories as $category):
            $args = [
                'type'=>'post',
                'posts_per_page'=>1,
                'category__in'=>$category->term_id,
                'category__not_in'=>[71]

            ];
            $blogs = new WP_Query($args);
            
            if ($blogs->have_posts()):
                while($blogs->have_posts()):$blogs->the_post();?>
                <header>
                <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
                </header>
                <p><?php the_content(); ?></p>

                <?php
                endwhile;
            endif;
            wp_reset_postdata();

        endforeach;
    ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>