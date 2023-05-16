<!-- <h3>This is the create members template</h3> -->

<div class="wrap">
    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php  
            settings_fields('cohort13_options_group');

            do_settings_sections('members_menu');

            submit_button();
        ?>
    </form>
</div>