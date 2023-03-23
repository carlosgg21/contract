$(document).ready(function () {



	var element = document.querySelector('.chart1');
	new EasyPieChart(element, {
		size: '160',
		barColor: '#00C292',
		lineWidth: 7,

	});

	var element = document.querySelector('.chart2');
	new EasyPieChart(element, {
		size: '160',
		barColor: '#01C0C8',
		lineWidth: 7,
	});

	var element = document.querySelector('.chart3');
	new EasyPieChart(element, {
		size: '160',
		barColor: '#FB9678',
		lineWidth: 7,
	});



	$.getJSON('http://registro_contrato.test/inicio/grafico', function (resp) {
		// $.each(resp, function (k, v) {
		// 	console.log(k + ' : ' + v);
		// });
				console.log(resp);
				// Morris bar chart
				Morris.Bar({
					element: 'morris-bar-chart',
					data: resp,
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Firmados', 'Expirados'],
					barColors: ['#193962', '#EB6E6E'],
					hideHover: 'auto',
					gridLineColor: '#eef0f2',
					resize: true
				});

	});


	


// Morris bar chart
// Morris.Bar({
// 	element: 'morris-bar-chart',
// 	data: [{
// 		y: '2006',
// 		a: 100,
// 		b: 90,
	
// 	}, {
// 		y: '2007',
// 		a: 75,
// 		b: 65,
	
// 	}, {
// 		y: '2008',
// 		a: 50,
// 		b: 40,
	
// 	}, {
// 		y: '2009',
// 		a: 75,
// 		b: 65,

// 	}, {
// 		y: '2010',
// 		a: 50,
// 		b: 40,
	
// 	}, {
// 		y: '2011',
// 		a: 75,
// 		b: 65,

// 	}, {
// 		y: '2012',
// 		a: 100,
// 		b: 90,
	
// 	}],
// 	xkey: 'y',
// 	ykeys: ['a', 'b'],
// 	labels: ['Firmados', 'Expirados'],
// 	barColors: ['#193962', '#EB6E6E'],
// 	hideHover: 'auto',
// 	gridLineColor: '#eef0f2',
// 	resize: true
// });


})
