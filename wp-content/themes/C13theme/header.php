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
    if(is_front_page()):
        $custom_classes = ['c13-home-class', 'my-class-c13'];
    else:
        $custom_classes = ['other-c13-class', 'c13-other-class'];
    endif;
?>
<body <?php body_class($custom_classes) ?>>
    <?php wp_nav_menu(['theme_location'=>'primary']);?>