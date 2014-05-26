<?php
	
	class Graph
	{
		
    private static $id;

		public static function SelectElement($id)
		{
			self::$id = $id;
		}

		public static function HitDaily()
		{
      $hits = Config::$default['hits'];
			$id = "'#".self::$id."'";
			?>
			<script>
		 	<?php
      		$c = new HyperCounter();
    	  	$c->open();
 		 	?>
			$(function(){
      			var bar = new GraphBar({
        			attachTo: <?php echo $id; ?>,
        			height: '400px',
        			width: '100%',
        			yDist: 30,
        			xDist: 100,
        			scale: 5,
        			showPoints: true,
        			        x: [
              <?php 
        			    $r = $c->gbl_testbuild1($hits,'h_date',7);
        			    $v =  array();
        			    foreach ($r as $s) 
        			    {
        			    	array_push($v,"'".$s['h_date']."'");
        			    }
        			    echo implode(",",$v);
        			 ?>
                        ],
        			xGrid: false,
        			legend: true,
        			points: [
          			<?php 
           			$r = $c->gbl_testbuild1($hits,'h_date',7);
           			$v =  array();
          			foreach($r as $s) 
          			{
            			$count =  $c->count('h_date',$s['h_date']);
          				array_push($v, $count);
          			}
          			echo implode(", ", $v)
          			?>],
          			colors: ['#ff0', '#333'],
          			dataNames: ['Hits'],
          			xName: 'Day',
          			tooltipWidth: 15,
          			design: {
          			  tooltipColor: '#fff',
          			  gridColor: 'black',
          			  tooltipBoxColor: 'green',
          			  averageLineColor: 'blue',
          			}
      			});
     			bar.init();
   		 	});
    		<?php  $c->close(); ?>
			</script>
			<?php 
		}

		public static function HitTopPage()
		{
			$id = "'#".self::$id."'";
			?>
			<script>
		 	<?php
      			$c = new HyperCounter();
    	  		$c->open();
 		 	?>
			$(function(){
      			var bar = new GraphBar({
        			attachTo: <?php echo $id; ?>,
        			height: '400px',
        			width: '100%',
        			yDist: 30,
        			xDist: 100,
        			scale: 5,
        			showPoints: true,
        			        x: [<?php 
        			    $r = $c->group_by_limit('hits','page',10);
        			    $v =  array();
        			    foreach ($r as $s) 
        			    {
        			    	array_push($v,"'".$s['page']."'");
        			    }
        			    echo implode(",",$v);
        			  ?>],
        			xGrid: false,
        			legend: true,
        			points: [
          			<?php 
           			$r = $c->group_by_limit('hits','page',10);
           			$v =  array();
          			foreach($r as $s) 
          			{
            			$count =  $c->count('page',$s['page']);
          				array_push($v, $count);
          			}
          			echo implode(", ", $v)
          			?>],
          			colors: ['#ff0', '#333'],
          			dataNames: ['Hits'],
          			xName: 'Day',
          			tooltipWidth: 15,
          			design: {
          			  tooltipColor: '#fff',
          			  gridColor: 'black',
          			  tooltipBoxColor: 'green',
          			  averageLineColor: 'blue',
          			}
      			});
     			bar.init();
   		 	});
    		<?php  $c->close(); ?>
			</script>
			<?php 
		}

		public static function UniqueDaily()
		{
      $info = Config::$default['info'];
			$id = "'#".self::$id."'";
			?>
			<script>
		 	<?php
      			$c = new HyperCounter();
    	  		$c->open();
 		 	?>
			$(function(){
      			var bar = new GraphBar({
        			attachTo: <?php echo $id; ?>,
        			height: '400px',
        			width: '100%',
        			yDist: 30,
        			xDist: 100,
        			scale: 5,
        			showPoints: true,
        			        x: [<?php 
        			    $r = $c->gbl_testbuild1($info,'c_date',2);
        			    $v =  array();
        			    foreach ($r as $s) 
        			    {
        			    	array_push($v,"'".$s['c_date']."'");
        			    }
        			    echo implode(",",$v);
        			  ?>],
        			xGrid: false,
        			legend: true,
        			points: [
          			<?php 
                $r = $c->gbl_testbuild1($info,'c_date',2);
                $v =  array();
                foreach($r as $s) 
                {
                   $count =  $c->count_testbuild1($info,'c_date',$s['c_date']);
                   array_push($v, $count);
                }
                echo implode(", ", $v)
                ?>

                ],
          			colors: ['#ff0', '#333'],
          			dataNames: ['Hits'],
          			xName: 'Day',
          			tooltipWidth: 15,
          			design: {
          			  tooltipColor: '#fff',
          			  gridColor: 'black',
          			  tooltipBoxColor: 'green',
          			  averageLineColor: 'blue',
          			}
      			});
     			bar.init();
   		 	});
    		<?php  $c->close(); ?>
			</script>
			<?php 
		}

		public static function ComboDaily()
		{
      $hits = Config::$default['hits'];
      $info = Config::$default['info'];
      $id = "'#".self::$id."'";
      ?>
      <script>
      <?php
          $c = new HyperCounter();
          $c->open();
      ?>
      $(function(){
            var bar = new GraphBar({
              special: 'combo',
              attachTo: <?php echo $id; ?>,
              height: '400px',
              width: '100%',
              yDist: 30,
              xDist: 100,
              scale: 5,
              showPoints: true,
                      x: [
    
               <?php 
                  $r = $c->gbl_testbuild1($hits,'h_date',2);
                  $v =  array();
                  foreach ($r as $s) 
                  {
                    array_push($v,"'".$s['h_date']."'");
                  }
                  echo implode(",",$v);
                ?>
                        ],
              xGrid: true,
              legend: true,
              points: [
               [<?php 
                $r = $c->gbl_testbuild1($hits,'h_date',7);
                $v =  array();
                foreach($r as $s) 
                {
                  $count =  $c->count('h_date',$s['h_date']);
                  array_push($v, $count);
                }
                echo implode(", ", $v)
                ?>],
               [<?php 
                $r = $c->gbl_testbuild1($info,'c_date',2);
                $v =  array();
                foreach($r as $s) 
                {
                   $count =  $c->count_testbuild1($info,'c_date',$s['c_date']);
                   array_push($v, $count);
                }
                echo implode(", ", $v)
                ?>]

               ],
                colors: ['#666', '#111'],
                dataNames: ['Hits','Unique'],
                xName: 'Day',
                tooltipWidth: 15,
                design: {
                  tooltipColor: '#fff',
                  gridColor: 'black',
                  tooltipBoxColor: 'green',
                  averageLineColor: '#999',
                }
            });
          bar.init();
        });
        <?php  $c->close(); ?>
      </script>
      <?php 
		}

		public static function ClearElement()
		{
			self::$id = null;
		}
	}
?>