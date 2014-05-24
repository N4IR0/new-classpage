<div id="chartdiv" style="width:100%; height:400px;"></div>

<script type="text/javascript">

	<?php
		$query= "SELECT `date` FROM `homework` ORDER BY `date`";
		$result= mysql_query($query);
		$i_total = mysql_num_rows($result);
		$i = 1;

		while($row = mysql_fetch_assoc($result)) {
			if (isset($count[$row['date']])) {
				$count[$row['date']]++;
			} else {
				$count[$row['date']] = 1;
			}
		}

		$js ="var chartData= [\n";

		foreach ($count as $timestamp => $value) {
			$year = date("Y",$timestamp);
			$month = date("n",$timestamp);
			$day = date("j",$timestamp);
			if ($i == $i_total) {
				$js .="{date: new Date($year, $month, $day, 0, 0, 0, 0), val:$value}\n";
			} else {
				$js .="{date: new Date($year, $month, $day, 0, 0, 0, 0), val:$value},\n";
			}
			$i++;
		}
		$js .="];\n";
		echo $js;
	?>

	AmCharts.ready(function() {
		var chart = new AmCharts.AmStockChart();
		chart.pathToImages = "style/js/amcharts/images/";

		var dataSet = new AmCharts.DataSet();
		dataSet.dataProvider = chartData;
		dataSet.fieldMappings = [{fromField:"val", toField:"value"}];
		dataSet.categoryField = "date";
		chart.dataSets = [dataSet];

		var stockPanel = new AmCharts.StockPanel();
		chart.panels = [stockPanel];

		var legend = new AmCharts.StockLegend();
		stockPanel.stockLegend = legend;

		var panelsSettings = new AmCharts.PanelsSettings();
		panelsSettings.startDuration = 1;
		chart.panelsSettings = panelsSettings;

		var graph = new AmCharts.StockGraph();
		graph.valueField = "value";
		graph.type = "column";
		<?php echo "graph.title = \"Hausaufgaben pro Tag ( Insgesamt $i_total )\";"; ?>
		graph.fillAlphas = 1;
		stockPanel.addStockGraph(graph);

		var categoryAxesSettings = new AmCharts.CategoryAxesSettings();
		categoryAxesSettings.dashLength = 1;
		chart.categoryAxesSettings = categoryAxesSettings;

		var valueAxesSettings = new AmCharts.ValueAxesSettings();
		valueAxesSettings .dashLength = 1;
		chart.valueAxesSettings  = valueAxesSettings;

		var chartScrollbarSettings = new AmCharts.ChartScrollbarSettings();
		chartScrollbarSettings.graph = graph;
		chartScrollbarSettings.graphType = "line";
		chart.chartScrollbarSettings = chartScrollbarSettings;

		var chartCursorSettings = new AmCharts.ChartCursorSettings();
		chartCursorSettings.valueBalloonsEnabled = true;
		chart.chartCursorSettings = chartCursorSettings;

		var periodSelector = new AmCharts.PeriodSelector();
		periodSelector.periods = [{period:"DD", count:1, label:"1 day"},
			{period:"DD", selected:true, count:5, label:"5 days"},
			{period:"MM", count:1, label:"1 month"},
			{period:"YYYY", count:1, label:"1 year"},
			{period:"YTD", label:"YTD"},
			{period:"MAX", label:"MAX"}];
		chart.periodSelector = periodSelector;

		chart.write("chartdiv");
	});
</script>
<br />