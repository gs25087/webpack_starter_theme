<?php

/*
Plugin Name: My Plugin
Description: Plugin tests
Version: 1.1
Author: Gintare Simutyte
*/

add_filter('the_content',array('hotwebideas_fix_wordpress','fix_spelling'));

class hotwebideas_fix_wordpress
{
	function fix_spelling($content)
	{

		$content= str_replace('Wordpress','WordPress',$content);
		$content = $content . "<hr/>Thank you for watching this video tutorial.";
		return "$content";
	}

}

add_action('show_user_profile', 'my_show_extra_profile_fields');
add_action('personal_options_update', 'my_save_extra_profile_fields');

function my_show_extra_profile_fields( $user ) { ?>

  <h3> Employee Information </h3>

  <table class="form-table">

  <tr>
  <th><label for="jobtitle"> Job Title</label></th>

  <td>
 
  <input type="text" name="jobtitle" id="jobtitle" value="<?php echo esc_attr(get_the_author_meta('jobtitle', $user->ID));?>" class="regular-text">
  <span class="description"> Please enter your title. </span>

  </td>
  </tr>

  <tr>
  <th><label for="jobtitle"> Years of experience</label></th>

  <td>
 
  <input type="text" name="yearsofexperience" id="yearsofexperience" value="<?php echo esc_attr(get_the_author_meta('yearsofexperience', $user->ID));?>" class="regular-text">
  <span class="description"> Please enter a number. </span>

  </td>
  </tr>

  </table>

<?php }

function my_save_extra_profile_fields ($user_id) {

  if (!current_user_can('edit_user', $user_id))
  return false;

  update_usermeta( $user_id, 'jobtitle', $_POST['jobtitle']);
  update_usermeta( $user_id, 'yearsofexperience', $_POST['yearsofexperience']);
}