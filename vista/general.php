
<html>
    <head>
        <title>title</title>
        <link href="<?=CSS?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?= CSS ?>datatables.css" rel="stylesheet" type="text/css"/>
        
        <style>
            .error{
                background-color: red;
            }
        </style>
        
        <script src="<?=JS?>jquery-3.3.1.js" type="text/javascript"></script>
        <script src="<?=JS?>popper.min.js" type="text/javascript"></script>
        <script src="<?=JS?>bootstrap.js" type="text/javascript"></script>       
        <!-- Validación -->
       
        <script src="<?= JS ?>jquery.validate.js" type="text/javascript"></script>  
         <script src="<?= JS ?>additional-methods.js" type="text/javascript"></script>
         
         <!-- Datatable -->
        <script src="<?= JS ?>datatables.js" type="text/javascript"></script>
         
    </head>
    <body>
        
        
        
            <div id="principal">                

            </div>                        
       
        
<!--        Mensaje Modal--><!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Cambiar mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
        
        
    </body>
</html>

