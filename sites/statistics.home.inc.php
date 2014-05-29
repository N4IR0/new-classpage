<?php $genericStats = getGenericStats(); ?>
<h3>Allgemeine Statistik</h3>
<br />
<table>
	<thead>
		<th>Art</th>
		<th>Anzahl</th>
	</thead>
	<tbody>
		<tr>
			<td>Registrierte Benutzer</td>
			<td><?php echo $genericStats['userscount']; ?></td>
		</tr>
		<tr>
			<td>Erfasste Lehrer</td>
			<td><?php echo $genericStats['teacherscount']; ?></td>
		</tr>
		<tr>
			<td>Eingetragene Stundenplanänderungen</td>
			<td><?php echo $genericStats['substitutioncount']; ?></td>
		</tr>
		<tr>
			<td>Eingetragene Arbeiten</td>
			<td><?php echo $genericStats['testscount']; ?></td>
		</tr>
		<tr>
			<td>Eingetragene Hausaufgaben</td>
			<td><?php echo $genericStats['homeworkcount']; ?></td>
		</tr>
	</tbody>
</table>
<br />
<h3>Verteilung der Hausaufgaben nach Datum</h3>
<div id="homeworkdiv" style="width:100%; height:400px;"></div>
<br />
<h3>Verteilung der Hausaufgaben nach Fach</h3>
<div id="homeworkpiediv" style="width:100%; height:400px;"></div>


<script type="text/javascript">

	<?php
	echo getChartData("chartData", "totalChart","homework");
	echo getChartData("chartDataPie", "totalPie","homework");
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
		periodSelector.periods = [
			{period:"DD", selected:true, count:5, label:"5 days"},
			{period:"MM", count:1, label:"1 month"},
			{period:"YYYY", count:1, label:"1 year"},
			{period:"YTD", label:"YTD"},
			{period:"MAX", label:"MAX"}];
		chart.periodSelector = periodSelector;

		chart.write("homeworkdiv");


		var chartPie = new AmCharts.AmPieChart();
		chartPie.valueField = "value";
		chartPie.titleField = "title";
		chartPie.dataProvider = chartDataPie;
		chartPie.depth3D = 20;
		chartPie.angle = 50;
		chartPie.write("homeworkpiediv");

	});
</script>

<br />