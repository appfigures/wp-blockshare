<div class="wrap">
	<h2>BlockShare</h2>
	<form method="post" action="options.php">
		<?php settings_fields('blockshare'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Block pattern:</th>
				<td><input type="text" name="bs_pattern" value="<?php echo get_option('bs_pattern'); ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<p>By default, BlockShare will apply to all <code>&lt;blockquote&gt;</code> elements</p>
					<p>Custom patterns should follow the following pattern: <code>/(opening)(content)(closing)/is</code></p>
					<p>
						<ul>
							<li><code>(opening)</code> - Matches the opening tag</li>
							<li><code>(content)</code> - Match the content. In most cases <code>.*?</code> is sufficient</li>
							<li><code>(closing)</code> - Match the closing tag. The BlockShare span will be added right before this tag</li>
						</ul>

						Example: Use BlockShare on headers <code>/(&lt;h\d&gt;)(.*?)(&lt;/h\d&gt;)/is</code>
					</p>
				</td>
			</tr>
                        <tr valign="top">
                                <th scope="row">Twitter handle:</th>
                                <td>@<input type="text" name="bs_via" value="<?php echo get_option('bs_via'); ?>" /></td>
                        </tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<?php submit_button(); ?>
	</form>
</div>
