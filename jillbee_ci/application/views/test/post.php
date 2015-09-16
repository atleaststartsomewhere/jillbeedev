<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div>
	<h2>Unit Test <?php echo $title; ?></h2>
	<span><?php echo $description; ?></span>
	<div>
		<?= form_open($url, array("id" => $title, "target" => $title)); ?>
			<?php foreach ($values as $name => $value) : ?>
				<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
			<?php endforeach; ?>
		<?= form_close(); ?>
		<iframe name="<?php echo $title; ?>"></iframe>
		<script type="text/javascript">document.getElementById('<?php echo $title; ?>').submit();</script>
	</div>
</div>