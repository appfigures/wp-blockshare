<div class="wrap">
	<h2>BlockShare</h2>
	<form method="post" action="options.php">
		<?php settings_fields('blockshare'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Custom block pattern:</th>
				<td>Open: <input type="text" name="bs_opener" value="<?php echo get_option('bs_opener'); ?>" />
					<br>Close: <input type="text" name="bs_closer" value="<?php echo get_option('bs_closer'); ?>" />
				</td>
			</tr>
                        <tr valign="top">
                                <th scope="row">Twitter handle:</th>
                                <td>@<input type="text" name="bs_via" value="<?php echo get_option('bs_via'); ?>" /></td>
                        </tr>
			<tr valign="top">
				<th scope="row">Use custom css</th>
				<td><input type="checkbox" name="bs_custom_css" value="1" <?php checked(get_option('bs_custom_css'), 1) ?> /></td>
		</table>
		<input type="hidden" name="action" value="update" />
		<?php submit_button(); ?>
	</form>
</div>
