<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div>
	<h2>Unit Test <?php echo $title; ?></h2>
	<span><?php echo $description; ?></span>
	<div>
		<?php 
		$full_url = base_url().'index.php/'.$url;
		foreach ( $values as $key => $value ) { 
			$full_url .= '?'.$key.'='.$value.'&';
		} ?>	
		<iframe src="<?php echo $full_url;?>"></iframe>
	</div>
</div>