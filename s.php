<?php include('core/db_glue.php'); ?>

<html>
	<head>
		<title><?php echo $title = 'Index'; ?></title>
		<?php counts($title); ?>
	</head>
	<body>
			<?php 
			$c = new HyperCounter();
			$c->open();
				$r = $c->group_by('page');

				foreach ($r as $s) {
					echo $t = $c->count('page',$s['page'])."-";
					echo $s['page']."<br />";
				}
			echo "<b>Total Hits: </b>".$c->counthits();

			$c->close();
		?>
	<br>
	<br>
	 Hello! This this a Test Page to test shitness. 
	</body>
</html>