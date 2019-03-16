<?php

/*
Plugin Name: Snappy List builder
Plugin URI: https://web.gintare.xyz
Description: The ultmimate plugin
Version: 1.0
Author: Gintare Simutyte
Author URI: https://web.gintare.xyz
License: GPL2
License URI: https://web.gintare.xyz
Text Domain: snapp-list-builder
*/


/* !0. TABLE OF CONTENTS */

/*
	
	1. HOOKS
		1.1 - registers all our custom shortcodes
		1.2 - register custom admin column headers
		1.3 - register custom admin column data
	
	2. SHORTCODES
		2.1 - slb_register_shortcodes()
		2.2 - slb_form_shortcode()
		
	3. FILTERS
		3.1 - slb_subscriber_column_headers()
		3.2 - slb_subscriber_column_data()
		3.2.2 - slb_register_custom_admin_titles()
		3.2.3 - slb_custom_admin_titles()
		3.3 - slb_list_column_headers()
		3.4 - slb_list_column_data()
		
	4. EXTERNAL SCRIPTS
		
	5. ACTIONS
		
	6. HELPERS
		
	7. CUSTOM POST TYPES
	
	8. ADMIN PAGES
	
	9. SETTINGS

*/




/* !1. HOOKS */

// 1.1
// hint: registers all our custom shortcodes on init
add_action('init', 'slb_register_shortcodes');

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-slb_subscriber_columns','slb_subscriber_column_headers');

// 1.3
// hint: register custom admin column data
add_filter('manage_slb_subscriber_posts_custom_column','slb_subscriber_column_data',1,2);
add_action(
    'admin_head-edit.php',
    'slb_register_custom_admin_titles'
);


/* !2. SHORTCODES */

// 2.1
// hint: registers all our custom shortcodes
function slb_register_shortcodes() {
	
	add_shortcode('slb_form', 'slb_form_shortcode');
	
}

// 2.2
// hint: returns a html string for an email capture form
function slb_form_shortcode( $args, $content="") {
  
  //get the list id
  $list_id = 0;
  if( isset($args['id'])) $list_id = (int)$args['id'];

	// setup our output variable - the form html 
	$output = '
	
		<div class="slb">
		
			<form id="slb_form" name="slb_form" class="slb-form" method="post"
      action="/wp-admin/admin-ajax.php?action=slb_save_subscription" method="post">
      
        <input type="hidden" name="slb_list" value="'. $list_id .'">

				<p class="slb-input-container">
				
					<label>Your Name</label><br />
					<input type="text" name="slb_fname" placeholder="First Name" />
					<input type="text" name="slb_lname" placeholder="Last Name" />
				
				</p>
				
				<p class="slb-input-container">
				
					<label>Your Email</label><br />
					<input type="email" name="slb_email" placeholder="ex. you@email.com" />
				
				</p>';
				
				// including content in our form html if content is passed into the function
				if( strlen($content) ):
				
					$output .= '<div class="slb-content">'. wpautop($content) .'</div>';
				
				endif;
				
				// completing our form html
				$output .= '<p class="slb-input-container">
				
					<input type="submit" name="slb_submit" value="Sign Me Up!" />
				
				</p>
			
			</form>
		
		</div>
	
	';
	
	// return our results/html
	return $output;
	
}




/* !3. FILTERS */

// 3.1
function slb_subscriber_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('Subscriber Name'),
		'email'=>__('Email Address'),
	);
	
	// returning new columns
	return $columns;
	
}

// 3.2
function slb_subscriber_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'title':
			// get the custom name data
			$fname = get_field('slb_fname', $post_id );
			$lname = get_field('slb_lname', $post_id );
			$output .= $fname .' '. $lname;
			break;
		case 'email':
			// get the custom email data
			$email = get_field('slb_email', $post_id );
			$output .= $email;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}

// 3.2.2
// hint: registers special custom admin title columns
function slb_register_custom_admin_titles() {
    add_filter(
        'the_title',
        'slb_custom_admin_titles',
        99,
        2
    );
}

// 3.2.3
// hint: handles custom admin title "title" column data for post types without titles
function slb_custom_admin_titles( $title, $post_id ) {
   
    global $post;
	
    $output = $title;
   
    if( isset($post->post_type) ):
                switch( $post->post_type ) {
                        case 'slb_subscriber':
	                            $fname = get_field('slb_fname', $post_id );
	                            $lname = get_field('slb_lname', $post_id );
	                            $output = $fname .' '. $lname;
	                            break;
                }
        endif;
   
    return $output;
}

// 3.3
function slb_list_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('List Name'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 3.4
function slb_list_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'example':
			// get the custom name data
			//$fname = get_field('slb_fname', $post_id );
			//$lname = get_field('slb_lname', $post_id );
			//$output .= $fname .' '. $lname;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}




/* !4. EXTERNAL SCRIPTS */




/* !5. ACTIONS */

// 5.1
// hint: saves subscription data to  an existing or new subscriber
function slb_save_subscription() {

  //setup default result data
  $result = array(
    'status' => 0,
    'message' => 'SUbscription was not saved. ',
  );

  //array for storing errors
  $errors = array();


  try {

    //get list id
    $list_id = (int)$_POST['slb_list'];

    //prepare subscriber data
    $subscriber_data = array(
      'fname'=> esc.attr( $_POST['slb_fname'] ),
      'lname'=> esc.attr( $_POST['slb_lname'] ),
      'email'=> esc.attr( $_POST['slb_email'] ),
    );

    //atempt to create/save subscriber
    $subscriber_id = slb_save_subscriber ( $subscriber_data );

    //IF subscriber was saved successfully $subscriber_id will be greater than 0
    if ( $subscriber_id ):

      // IF subscriber already has this subscription
      if( slb_subscriber_has_subscription( $subscribr_id, $list_id));

          //get list object
          $list = get_post( $list_id );

          //return detailed error
          $result['message'] .= esc_attr( $subscriber_data['email'] .' is already subscribed to '. $list->post_title .'.');
  else: 

    //save new subscription
    $subscription_saved = slb_add_subscription( $subscriber_id, $list_id);

    // IF subscription was saved successfully
    if( $subsciption_saved ):

			//Subscription saved!
			$result['status'] = 1;
			$result['message'] = 'Subscribtion saved';
		
		endif;
	endif;
endif;

} catch ( Exception $e) {
	// // a php error occurred
	// $result['error'] = 'Caught exception: '. $e->getMessage();
}

//return result as json
slb_return_json($result);

}


//5.2 
//hint: creates a new subscription or updates an existing one
function slb_save_subscriber ($subscriber_data) {
		// setup default subscriber id
		// 0 menas the subscriber was not saved
		$subscriber_id = 0;

		try {

			$subscriber_id = slb_get_subscriber_id( $subscriber_data['email']);

			//IF the subscriber does not already exist...
			if( !$subsciption_id):

				//add new subscriber to database
				$subscriber_id = wp_insert_post(
					array(
						'post_type'=>'slb_subscriber',
						'post_title'=>$subsciber_data['fname'] .' '. $subsciber_data['lname'],
						'post_status'=>'publish',
					),
					true
				);
			endif;

			//add/update custom meta data
			update_field(slb_get_acf_key('slb_fname'), $subsciber_data['fname'], $subscriber_id);
			update_field(slb_get_acf_key('slb_lname'), $subsciber_data['lname'], $subscriber_id);
			update_field(slb_get_acf_key('slb_email'), $subsciber_data['email'], $subscriber_id);

		} catch (Exception $e) {
			a php error occured
		}

		return $subscriber_id;

}


/* !6. HELPERS */

//6.1
//
//hint: returns true or false
function slb_subscriber_has_subscription( $subscriber_id, $list_id) {

	//setup default return value
	$has_subscription = false;

	//get subscriber
	$subscriber = get_post(§subscriber_id);

	//get subscriptions
	$subscriptions = slb_get_subscirptions( $subscriber_id); 

	//check subscriptions for $list_id
	if ( in_array($list_id, $subscriptions)):

		//found the $list_id in $subsciptions
		//this subscriber is already subscribed to this list
		$has_subscription = true;

	else: 

		//did not find $list_id in $subscriptions
		//this subscriber is not yet subscribed to this list
	
	endif;
	return $has_subscription;

}




/* !7. CUSTOM POST TYPES */




/* !8. ADMIN PAGES */




/* !9. SETTINGS */

