<?php

/**
  * The default sidebar template. Can be overriden by placing another template
  * file in 'your/theme/america-flexible-sidebar-templates/sidebar.php'
  *
  * @since 2.0.0
  * @package America_Flexible_Sidebar
  *
  */ ?>

  <aside class="sidebar sidebar-primary">
    <?php tha_sidebar_top(); ?>

    <?php while ( have_rows('america_sidebar') ) : the_row(); ?>

      <section class="flexible-sidebar">
        <?php the_sub_field('america_markup'); ?>
      </section>

    <?php endwhile; ?>

    <?php tha_sidebar_bottom(); ?>
  </aside>
</div><!-- .content-sidebar-wrap -->
