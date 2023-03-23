$(document).ready(function () {

     //visibilidad del div del filtro
     $('#btnFilter').click(function () {        
     	$('.divFilter').toggle("slide");
     });

     //reset filtros y pagina 
     $('#btnReset').click(function () {        
          location.replace(location.pathname);     
     });

     $('#btnExport').click(function () {
          console.log('das')
     	$("table").tableExport();
     });




// $('#contratos').DataTable({
// 	dom: 'Bfrtip',
// 	buttons: [
// 		'copy', 'excel', 'pdf'
// 	]
// });

});