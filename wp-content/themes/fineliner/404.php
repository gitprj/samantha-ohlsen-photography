<?php get_header(); ?>

<hr class="layout-divider content-width" />

<div id="intro" class="row no-margin-bottom page-404">
    <div class="large-9 large-centered columns">
        <h1><?php _e( '404 <span>Page Not Found</span>', 'uxbarn' ); ?></h1>
        <p>
            <?php _e( 'The requested page could not be found or it is currently unavailable.', 'uxbarn'); ?> 
            <br/>
            <?php printf(__('Please <a href="%s">click here</a> to go back to our home page or use the search form below.', 'uxbarn'), home_url()); ?>
        </p>
    </div>
</div>
<div class="row no-margin-bottom">
    <div class="large-6 columns large-centered">
      <?php get_template_part( 'searchform', '404' ); ?>
    </div>
</div>
        
<?php get_footer(); ?>