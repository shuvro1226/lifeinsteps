<div id="comments">
	<?php
	
		if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');
	
		if ( post_password_required() ) { ?>
			<?php esc_html_e('This post is password protected. Enter the password to view comments.', 'voyager'); ?>
		<?php
			return;
		}
	?>
	
	<?php if ( have_comments() ) : ?>
		
		<div class="commentlist_wrap">
			<div class="comments_title">
				<h2 class="comments-count"><?php echo esc_html__('Comments','voyager'); ?></h2>
				<b>
					<?php printf(
						_n(esc_html__('1 Comment', 'voyager'),
						'%1$s ' . esc_html__('Comments', 'voyager'),
						get_comments_number()),
						number_format_i18n(get_comments_number())
						);
					?>
				</b>
			</div>
		
			<div class="navigation">
				<div class="next-posts"><?php previous_comments_link() ?></div>
				<div class="prev-posts"><?php next_comments_link() ?></div>
			</div>
		
			<ol class="commentlist clearfix">
				<?php wp_list_comments(array('callback' => 'cstheme_comment' )); ?>
			</ol>
		
			<div class="navigation">
				<div class="next-posts"><?php previous_comments_link() ?></div>
				<?php paginate_comments_links(); ?> 
				<div class="prev-posts"><?php next_comments_link() ?></div>
			</div>
		</div>
		
	 <?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->
	
		 <?php else : // comments are closed ?>
			<p class="hidden"><?php esc_html_e('Comments are closed.', 'voyager'); ?></p>
	
		<?php endif; ?>
		
	<?php endif; ?>
		
		
<?php if ( comments_open() ) : ?>

	<?php
	
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		//Custom Fields
		$fields =  array(
			'author'=> '<div id="respond-inputs" class="clearfix"><div class="comment-form-author"><input id="author" name="author" placeholder="'. esc_html__('Name *','voyager') .'" type="text" value="" size="30"'. $aria_req .' /></div>',
			'email' => '<div class="comment-form-email"><input id="email" name="email" placeholder="'. esc_html__('E-mail *','voyager') .'" type="text" value="" size="30"'. $aria_req .' /></div>',
			'url' => '<div class="comment-form-url"><input id="url" name="url" placeholder="'. esc_html__('Web site','voyager') .'" type="text" value="" size="30"'. $aria_req .' /></div></div>',
		);

		//Comment Form Args
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>esc_html__('Leave A Comment', 'voyager'),
			'comment_field' => '<div id="respond-textarea"><textarea id="comment" name="comment" placeholder="'. esc_html__('Comment *','voyager') .'" aria-required="true" cols="58" rows="10" tabindex="4"></textarea></div>',
			'comment_notes_after' => '',
			'label_submit' => esc_html__('Post comment','voyager')
		);
		
		// Show Comment Form
		comment_form($comments_args); 
	?>


<?php endif; // if you delete this the sky will fall on your head ?>

</div>