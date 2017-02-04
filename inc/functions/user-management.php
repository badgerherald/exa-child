<?php
/**
 * !!! Warning !!!
 * Only touch this file if you absolutely know what you're doing. 
 * 
 * Doing the wrong thing here may mean giving students access to edit content.
 * 
 * -wjh
 */


/**
 * Enque styles used for this plugin.
 *
 */
function hrld_set_roles() {

	$contributor = array(									// CONTRIBUTORS CAN:
					'read'         				=> true,	// + read posts.
					'delete_posts' 				=> true,	// + delete posts (their own). 
					'edit_posts'   				=> true,	// + edit posts.
				);

	$associates = $contributor 
				+ array(									// ASSOCIATES can do everything STAFF CONTRIBUTORS can, plus:
					'edit_others_posts'			=> true,	// + edit others posts
				);

	$copy = $contributor;									// COPY can do everything CONTRIBUTORS can,
															// just with a different name.
	
	$editor_role = get_role('editor');						// EDITORS get everthing the default WordPress editors
	$editors = $editor_role->capabilities;					// can do.

	$management = $editors 
				+ array(									// ASSOCIATES can do everything STAFF WRITERS can, plus:
					'create_users'			=> true,		// + create users
					'edit_users'			=> true,		// + edit users
					'list_users'			=> true,		// + list users
					'promote_users'			=> true,		// + promote users
					'remove_users'			=> true,		// + remove users
					'edit_theme_options'	=> true,		// + edit menus and stuff
					'customize'				=> true,		// + give access to customizer
					'manage_options'		=> true,		// + manage options
				);
	
	remove_role('contributor'); 				// For development.
	remove_role('associates');
	remove_role('copy');
	remove_role('management');

	add_role('contributor','Contributor',$contributor);
	add_role('associates','Associate',$associates);
	add_role('copy','Copy',$copy);
	add_role('management','Management',$management);

}
register_activation_hook( 'hrld-setup/hrld-setup.php', 'hrld_set_roles' );
add_action('init', 'hrld_set_roles');
