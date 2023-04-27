<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C13theme</title>
    <?php wp_head(); ?>
</head>
<?php
if (is_front_page()):
    $custom_classes = ['c13-home-class', 'my-class-c13'];
else:
    $custom_classes = ['other-c13-class', 'c13-other-class'];
endif;
?>

<body <?php body_class($custom_classes) ?>>
    <?php //wp_nav_menu(['theme_location'=>'primary']);?>

    <!-- NAVWALKER -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="http://localhost/customtheme/">C-THEME</a>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'depth' => 2,
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'bs-example-navbar-collapse-1',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
            ?>
        </div>
    </nav>
    <div>
        <?php get_search_form(); ?>
    </div>

    <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>"
        width="<?php echo get_custom_header()->width; ?>">