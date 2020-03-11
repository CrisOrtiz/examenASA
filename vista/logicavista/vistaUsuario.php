<?php

class vistalogica {    
    
    function vistaActualizar($datos){
        $cad='<div class="container">
            <form id="formaspirantefinal">
        <fieldset>
          <legend>Actualizar datos de usuario</legend>
      <div class="form-group">

        <div class="col-lg-4">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Carnet</label>
            <input type="text" class="form-control" id="inputDefault" name="ci" value='.$datos->ci.'>
          </div>
         </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Nombre: </label>
            <input type="text" class="form-control" id="inputDefault" name="nombre" value='.$datos->nombre.'>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Apellido paterno</label>
            <input type="text" class="form-control" id="inputDefault" name="apaterno" value='.$datos->apaterno.'>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Apellido materno</label>
            <input type="text" class="form-control" id="inputDefault" name="amaterno" value='.$datos->amaterno.'>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="inputDefault" name="fnacimiento" value='.$datos->fnacimiento.'>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Correo</label>
            <input type="text" class="form-control" id="inputDefault" name="correo" value='.$datos->correo.'>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Usuario</label>
            <input type="text" class="form-control" id="inputDefault" name="folio" value='.$datos->folio.'>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label class="control-label" for="inputDefault">Clave de acceso</label>
            <input type="text" class="form-control" id="inputDefault" name="clave" value='.$datos->clave.'>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <input type="text" hidden name="id" value='.$datos->id.'> 
            <button type="button" class="btn btn-success btn-block" onclick="updAspirante()">Guardar cambios</button>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
  </div>';
        return $cad;
    }


    function vistaActualizarPregunta($datos){
      $cad2='<div class="container">
          <form id="formpreguntafinal">
      <fieldset>
        <legend>Actualizar datos de la pregunta</legend>
    <div class="form-group">

      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">Pregunta: </label>
          <input type="text" class="form-control" id="inputDefault" name="texto" value='.$datos->texto.'>
        </div>
       </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">respuesta 1:</label>
          <input type="text" class="form-control" id="inputDefault" name="respuesta1" value='.$datos->respuesta1.'>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">valor1</label>
          <input type="text" class="form-control" id="inputDefault" name="valor1" value='.$datos->valor1.'>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">respuesta 2:</label>
          <input type="text" class="form-control" id="inputDefault" name="respuesta2" value='.$datos->respuesta2.'>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">valor 2:</label>
          <input type="text" class="form-control" id="inputDefault" name="valor2" value='.$datos->valor2.'>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">respuesta 3:</label>
          <input type="text" class="form-control" id="inputDefault" name="respuesta3" value='.$datos->respuesta3.'>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label class="control-label" for="inputDefault">valor 3:</label>
          <input type="text" class="form-control" id="inputDefault" name="valor3" value='.$datos->valor3.'>
        </div>
      </div>

  </fieldset>
</form>
</div>';
      return $cad2;
  }
    
}
?>