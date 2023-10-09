<?php 
Class Latest_Services_Cat_List_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('bdevs-services-cats-list', 'Ninico Tag List', array(
			'description'	=> 'Ninico Tag List Show'
		));
	}


	public function widget($args, $instance){

		extract($args);
	 	echo $before_widget; 
	 	if($instance['title']):
     	echo $before_title; ?> 
     	<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
     	<?php echo $after_title; ?>
     	<?php endif; ?>

			<div class="footer-widget__links keyword">

			<?php 
				$categories = get_terms( array(
					'taxonomy' => 'post_tag',
					'hide_empty' => true,
					'order' => $instance['posts_order'],
				) );
				?>
				<?php if ( !empty($categories) ) : ?>
				<?php foreach ( $categories as $category ) : ?>

				<a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>

				<?php endforeach; ?>
				<?php endif; ?>
				<?php 
			
			?> 
			</div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tocores' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tocores' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}




add_action('widgets_init', function(){
	register_widget('Latest_Services_Cat_List_Widget');
});