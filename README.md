# America Flexible Sidebar

The America Flexible Sidebar plugin allows content editors to override global sidebars with page or post specific sidebars. Currently, it only provides a HTML field via the [Advanced Custom Fields](https://www.advancedcustomfields.com) plugin.

## Outputting the content of the flexible sidebar

### Theme Hook Alliance method

This plugin is designed to hook into the Theme Hook Alliance's `tha_sidebars_before` action hook.

#### Overriding the default template

The America Flexible Sidebar makes use of the [Gamajo Template Loader](https://github.com/GaryJones/Gamajo-Template-Loader), which means that you can override this plugin's default sidebar template, found at `public/templates/sidebar.php`.

To do so, create a directory in your theme called `america-flexible-sidebar-templates` and place a `sidebar.php` template within that directory.

### Manually

If you don't use the THA action hooks, you can also add something like the following to output to a template, like `your-theme/sidebar.php`:

```php
<?php if ( class_exists('America_Flexible_Sidebar') ) { ?>
	<aside class="sidebar sidebar-primary">
		<?php while ( have_rows('america_sidebar') ) : the_row(); ?>

			<section class="flexible-sidebar">
				<?php the_sub_field('america_markup'); ?>
			</section>

		<?php endwhile; ?>
	</aside>
<?php
  } else {
  // Insert default Wordpress sidebar code
  ...
  }
?>
```

*NOTE*: If you use the manual method above, you'll be sidestepping the Gamajo Template Loader.

## Available filters

Currently there's only one filter available: `america_sidebar_deregister`, which allows you to augment the list of sidebars to deactivate in `public/class-america-flexible-sidebar-public.php`.
