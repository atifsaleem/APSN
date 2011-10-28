<?php
    if ( ! current_user_can( 'promote_users' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.','contexture-page-security' ) );
?>