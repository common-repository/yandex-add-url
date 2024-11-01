<?php 
/**
Plugin name: Yandex Add Url
Description: Simply provide iframe from Yandex Add Url to your admin part for publishing/editing posts. So you can add url to Yandex inside wp admin.
Version: 1.1
Author: Nick Yurov
Author URI: http://nickyurov.com
*/
Class Ya_Add_Url{

	public function __construct(){
		if(is_admin()){
			add_action('init', array($this, 'ya_add_stylesheet'));
			add_action('init', array($this, 'ya_add_script'));
			add_action('add_meta_boxes', array($this, 'add_ya_custom_box'));
		}
	}
	
	function ya_add_stylesheet() {
		wp_register_style( 'add_url-style', plugins_url('style.css', __FILE__) );
		wp_enqueue_style( 'add_url-style' );
	}
	
	function ya_add_script() {
		wp_enqueue_script(
			'ZeroClipboard',
			plugins_url('ZeroClipboard.min.js', __FILE__),
			array('jquery')
		);
		wp_enqueue_script(
			'add_url',
			plugins_url('script.js', __FILE__),
			array('jquery')
		);
	}
		
	function add_ya_custom_box(){
		add_meta_box(
			'ny_add_url',
			'Yandex - Add URL', 
			array($this, 'ya_custom_box'),
			'',
			'advanced',
			'default'
		);
	}

	function ya_custom_box($post){?>
			<div class="ya-controls hide-if-no-js">
				<strong>Permalink:</strong> <span class="z-copy">Copy to clipboard</span>
				<span id="ya-permalink"><?php echo get_permalink($post->ID) ?></span>
				<span data-clipboard-text="<?php echo get_permalink($post->ID) ?>" id="z-copy" class="button button-small">Copy to clipboard</span>
				<span id="ya-hide" class="button button-small">Hide/show</span>
			</div>
			<div id="ya-iframe" class="open">
				<iframe id="add-url" src="http://webmaster.yandex.ua/addurl.xml" width="100%" height="90%"></iframe>
				<span class="ya-click-to-open button button-small">+ Click to add url</span>
			</div>
			<script type='text/javascript'>
				var clip = new ZeroClipboard( document.getElementById("z-copy"), {
					moviePath: "<?php echo plugin_dir_url(__FILE__); ?>ZeroClipboard.swf"
				});
			</script>
	<?php }
}

$Ya_Add_Url = new Ya_Add_Url();