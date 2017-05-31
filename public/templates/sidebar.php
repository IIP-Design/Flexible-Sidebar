<?php

/**
  * The default sidebar template. Can be overriden by placing another template
  * file in 'your/theme/america-flexible-sidebar-templates/sidebar.php'
  *
  * @todo Move the logic out of the template
  *
  * @since 2.0.0
  * @package America_Flexible_Sidebar
  *
  */ ?>

  <aside class="sidebar sidebar-primary">
    <?php tha_sidebar_top(); ?>

    <?php while ( have_rows('america_sidebar') ) : the_row(); ?>

      <section class="flexible-sidebar">
        <?php
        if ( get_row_layout() === 'html' ) :
          the_sub_field( 'america_markup' );
        endif;

        if ( get_row_layout() === 'site_categories' ) : ?>
        <ul class="category-list">
          <?php $instance = array( 'title' => get_sub_field( 'widget_title' ) ); ?>
          <?php the_widget('WP_Widget_Categories', $instance ); ?>
        </ul>
        <?php endif; ?>

        <?php
          if ( get_row_layout() === 'promoted_links' ) {
            $instance = array( 'title' => get_sub_field( 'widget_title' ) );
            the_widget( 'America_Promoted_Links_Widget', $instance );
          }
        ?>
      </section>

    <?php endwhile; ?>
  <?php tha_sidebar_bottom(); ?>
</aside>
