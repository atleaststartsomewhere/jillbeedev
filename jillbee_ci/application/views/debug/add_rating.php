<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= form_open('api/rating/') ?>
	<input type="text" placeholder="client" name="client" />
	<input type="text" placeholder="item" name="item"/>
	<input type="text" placeholder="rating" name="rating" />
	<button type="submit">Submit</button>
<?= form_close(); ?>