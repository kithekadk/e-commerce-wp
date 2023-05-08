<?php
/**
 * Template Name: View Books
 */
get_header();
?>
<?php

    global $wpdb;
    $table = $wpdb->prefix.'books';

    $books = $wpdb->get_results("SELECT * FROM $table");

    // echo '<pre>';
    // var_dump($books);
    // echo '</pre>'
    

?>

<div class="d-flex justify-content-center">
    <table class="table table-striped w-75">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Book Author</th>
                <th>Book Publisher</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($books as $book){
        ?>
                    
            <tr>
                <td><?php echo $book->title; ?></td>
                <td><?php echo $book->author; ?></td>
                <td><?php echo $book->publisher; ?></td>
            </tr>
        

        <?php } ?>
    </tbody>
    </table>
</div>
<?php get_footer();?>