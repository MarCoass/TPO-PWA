export var competidores_tabla = $('#competidores_tabla').DataTable( {
            
    ajax:  {	
        type: "POST",	
        url:  "MOCK_Competidores.json",
        dataSrc: '',
        data: {},
    },
    processing : true,
    responsive: true,
    ordering:true,
    "language": {
        "decimal": ",",
        "thousands": ".",
        "search": "Buscar: ",
        "processing": "Obteniendo datos...",
        "lengthMenu": "Mostrar _MENU_ elementos por página",
        "zeroRecords": "Sin resultados",
        "info": "Mostrando _PAGE_ de _PAGES_ páginas",
        "infoEmpty": "No se encontraron elementos",
        "infoFiltered": "(filtrado de _MAX_ total elementos)",
        "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    
    "lengthMenu": [[5,10,15,-1], [5,10,15, "Todos"]],
} );	

