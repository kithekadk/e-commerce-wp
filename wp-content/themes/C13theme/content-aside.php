<div class="row">
  <div class="col-sm-6">
<div class="card text-center bg-success">
  <div class="card-header">
  <h3><?php the_title(sprintf('<h2 class="entry-title"><a href= "%s">', esc_url(get_permalink() )), '</a></h2>'); ?></h3>
  </div>
  <div class="card-body">
    <h4> <?php the_content() ?> </h4>
    
  </div>
  <div class="card-footer text-muted">
    <h3> <?php the_date(); ?> </h3>
  </div>
</div>
</div>
</div>
<br>