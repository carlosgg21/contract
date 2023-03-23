$(document).ready(function () {


	//  $.ajax({
	//  	url: 'http://registro_contrato.test/reportes/vigentesPorYear',
	//  	type: 'get',
	//  	dataType: 'json',
	//  	success: function (result) {
	//  		console.log(result)
	//  	}
	//  });


	$('#reporte').DataTable({
		   retrieve: true,
		   destroy: true,
		     stateSave: true,
			       dom: 'frtip',
				   "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ãšltimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
		ajax: 'http://registro_contrato.test/reportes/vigentesPorYear',
		columnDefs: [ 
			{
				'searchable': false,
				'targets': [0, 1, 2, 4, 5, 6]
			},
		],
		 columns: [
            { data: 'no_contrato' },
            { data: 'no_suplemento' },
            { data: 'contract_status' },
            { data: 'year_firma' },
            { data: 'nombre_empresa' },
            { data: 'nombre_servicio' },
            { data: 'year_expira' },
        
        ],
	});





    	$.getJSON('http://registro_contrato.test/reportes/graficaByYear', function (resp) {
           

    	new Morris.Line({
    	  	element: 'morris-line-chart',
    	  	resize: true,
    	  	data: resp,
    	  	xkey: 'year_firma',
    	  	ykeys: ['cantidad'],
    	  	labels: ['Cantidad de contratos'],
    	  	gridLineColor: '#eef0f2',
    	  	lineColors: ['#009efb'],
    	  	lineWidth: 1,
    	  	hideHover: 'auto'
    	  });

    	});




});