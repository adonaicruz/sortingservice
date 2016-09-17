<?php
	require '../lib/SortingService.php';
	
	//loading json data to be sorted
	$json_data = file_get_contents("test.json");

	//Create a var with the orinal data to compare
	$vDataOrigin = json_decode($json_data, true);
	
	$ss = new SortingService($json_data);
	
	$vHeader = $ss->getHeader();

	if($_POST):
		foreach($_POST['FIELD'] as $k=>$column):
			if($column !== ''){
				$sorter[$column] = $_POST['SORT'][$k];
			}
		endforeach;
		

		if(count($sorter)){
			//sorts the data according to the specified parameters
			$ss->sort($sorter);

			print_r($ss->getId());

			$vDataSorted = $ss->getData();
		}
		
	endif;
	
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Security-Policy">
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
		<title>Sorting Service Client Example</title>
		
		<!-- Bootstrap -->
    	<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    	<style>
    		.wrap{
				width: 700px;
				margin:0 auto;
    		}
    	</style>
	</head>
	<body>

	<div class="wrap">
		<form action="" method="POST">
			<h1>Sorting Data</h1>
			<?php for($i=1;$i<=count($vHeader);$i++):?>
				<div class="form-inline">
					<div class="form-group">
						<label for="FIELD">Column</label>
						<select name="FIELD[<?php echo $i;?>]" class="form-control">
							<option value=""></option>
							<?php foreach($vHeader as $k=>$header):?>
								<option value="<?php echo $k;?>"><?php echo $header;?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label for="SORT">Order</label>
						<select name="SORT[<?php echo $i;?>]" class="form-control" >
							<option value="asc">ASC</option>
							<option value="desc">DESC</option>
						</select>
					</div>
			</div>
			<?php endfor;?>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>


		<h3>Original Data</h3>
		<div class="panel panel-default" >
		  	<table class="table table-striped">
		  		<?php foreach($vDataOrigin as $k=>$data_row):?>
			  		<tr>
		  				<?php foreach($data_row as $data_col):?>
			  				<td><?php echo $data_col?></td>
			  			<?php endforeach;?>
			  		</tr>
			  	<?php endforeach;?>
		  	</table>
		</div>
		
		<?php if(isset($vDataSorted) && count($vDataSorted)):?>
		  	<h3>Sorted Data</h3>

			<?php if($sorter):?>
				Table sorted: 
				<?php foreach($sorter as $sColumn=>$sOrder):?>
					<br/>Column: <?php echo $vHeader[$sColumn];?> | Order: <?php echo $sOrder;?>
				<?php endforeach;?>
			<?php endif;?>

		  	<div class="panel panel-default" >
			  	<table class="table table-striped">
			  		<?php foreach($vDataSorted as $k=>$data_row):?>
				  		<tr>
			  				<?php foreach($data_row as $data_col):?>
				  				<td><?php echo $data_col?></td>
				  			<?php endforeach;?>
				  		</tr>
				  	<?php endforeach;?>
			  	</table>
			</div>
		<?php endif;?>
	</div>
		
		
	</body>

	
	
</html>