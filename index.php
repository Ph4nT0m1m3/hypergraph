<?php include('core/db_glue.php'); ?>

<html>
	<head>
		<title><?php echo $title = "GraphView"; ?></title>
		<?php echo counts($title); ?>
	</head>
	<body>
		<h1>Daily Hits (Cookie Based)</h1>
		<div id="top1"></div>
		<h1>Daily Unique Hits (IP)</h1>
		<div id="top2"></div>
		<h1>Combo Hits (Cookie Based + IP)</h1>
		<div id="top3"></div>
		<h1>Top Pages</h1>
		<div id="top4"></div>
		
		<?php 
			$c = new HyperCounter();
			$c->open();
				echo "<b>Total Hits: </b>".$c->counthits();

			$c->close();
		?>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/graph.min.js"></script>
		<?php 
			Graph::SelectElement('top1');
			Graph::HitDaily(); 
			Graph::ClearElement();
			Graph::SelectElement('top2');
			Graph::UniqueDaily(); 
			Graph::ClearElement();
			Graph::SelectElement('top3');
			Graph::ComboDaily(); 
			Graph::ClearElement();
			Graph::SelectElement('top4');
			Graph::HitTopPage(); 
			Graph::ClearElement();
			?>
	</body>
</html>