@extends('admin.admin_master')
@section('admin')


<?php

$current_month=date('M Y',strtotime("-0 month"));
$months=array();
$count=0;

while($count<4){
    $months[] = date('M Y', strtotime("-".$count." month"));
    $count++;
}

foreach($categories as $key => $value){
    $dataPoints3[$key]['label']=$categories[$key]['category_name_en'];
    $dataPoints3[$key]['y']=$sales[$key]['count']/$total['count']*100;
}
 
$dataPoints = array(
	array("y" => $usersCount[3], "label" => $months[3]),
	array("y" =>  $usersCount[2], "label" => $months[2]),
	array("y" =>  $usersCount[1], "label" => $months[1]),
	array("y" =>  $usersCount[0], "label" => $months[0]),
	
);

$dataPoints2 = array( 
	array("y" => $ordersCount[3], "label" => $months[3]),
	array("y" =>  $ordersCount[2], "label" => $months[2]),
	array("y" =>  $ordersCount[1], "label" => $months[1]),
	array("y" =>  $ordersCount[0], "label" => $months[0]),
);

// $dataPoints3 = array( 

// 	// array("label"=>$categories[0]['category_name_en'], "y"=>$sales[0]['count']/$total['count']*100),
// 	// array("label"=>$categories[1]['category_name_en'], "y"=>$sales[1]['count']/$total['count']*100),
// 	// array("label"=>$categories[2]['category_name_en'], "y"=>$sales[2]['count']/$total['count']*100),
// 	// array("label"=>$categories[3]['category_name_en'], "y"=>$sales[3]['count']),
//     // array("label"=>$categories[4]['category_name_en'], "y"=>$sales[4]['count'])
 
// );
 
?>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Number of users registered during the last 4 months"
	},
	axisY: {
		title: "Number of users"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Number of orders placed during the last 4 months"
	},
	axisY: {
		title: "Number of orders"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## orders",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();

var chart3 = new CanvasJS.Chart("chartContainer3", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "The share of purchased products in each category"
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart3.render();
 
}
</script>


<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">



            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Graphs and charts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div id="chartContainer" style="height:450px; width: 100%;"></div>
                    <br>
                    <hr>
                    <br>
                    <div id="chartContainer2" style="height: 450px; width: 100%;"></div>
                    <br>
                    <hr>
                    <br>
                    <div id="chartContainer3" style="height: 450px; width: 100%;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->






        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection