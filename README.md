# America Flexible Sidebar

The America Flexible Sidebar plugin allows content editors to override global sidebars with page or post specific sidebars. Currently, it only provides a HTML field via the [Advanced Custom Fields](https://www.advancedcustomfields.com) plugin.

## Overriding the default template

The America Flexible Sidebar makes use of the [Gamajo Template Loader](https://github.com/GaryJones/Gamajo-Template-Loader), which means that you can override this plugin's default sidebar template, found at `public/templates/sidebar.php`.

To do so, create a directory in your theme called `america-flexible-sidebar-templates` and place a `sidebar.php` template within that directory.

## Available filters

Currently there's only one filter available: `america_sidebar_deregister`, which allows you to augment the list of sidebars to deactivate in `public/class-america-flexible-sidebar-public.php`.
