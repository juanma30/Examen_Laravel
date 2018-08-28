@extends('layout')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <a href="{{ $link }}">Ir a {{ $link }}</a>
  </div>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <input type="text" id="search_inp" value="" placeholder="Buscar" style="width: 100%;">
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12">
    <button type="button" id="search_btn" class="btn btn-info">Buscar</button>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12">
    <button type="button" id="search_btn" class="btn btn-success" href="#add_modal" data-toggle="modal">Nueva</button>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    @if( isset($_data) && $_data )
    <table class="table table-bordered">
      <?php echo $_data; ?>
    </table>
    @else
      <p>No se encontraron resultados</p>
    @endif
  </div>
</div>

<div class="modal fade" id="delete_reg" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Eliminar</h4>
			</div>
			<div class="modal-body">
				¿Estas seguro de eliminar este registro?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
				<a href="javascript:;" class="btn btn-sm btn-warning" id="del_yes">Si</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_reg" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Editar</h4>
			</div>
			<div class="modal-body">
        <form class="" action="index.html" method="post">
          <input type="text" name="" value="">
        </form>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_modal" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Agregar</h4>
			</div>
			<div class="modal-body">
        <form class="form-group" action="" method="post" name="new_reg" id="new_reg">
          @if( isset($met) && $met && $met == 'dependencias')
            <label>Nombre de la dependencia:
              <input type="text" name="name_depend" value="" placeholder="Nombre" class="form-control">
            </label>
          @else
          <label>Nombre:
            <input type="text" name="name_aut" value="" placeholder="Nombre" class="form-control">
          </label>
          <label>Apellido paterno:
            <input type="text" name="paterno_aut" value="" placeholder="Apellido paterno" class="form-control">
          </label>
          <label>Apellido materno:
            <input type="text" name="materno_aut" value="" placeholder="Apellido materno" class="form-control">
          </label>
          <label>Fecha de nacimiento:
            <input type="date" name="fecha_aut" value="" placeholder="fecha de nacimiento" class="form-control">
          </label>
          <label>Puesto:
            <input type="text" name="puesto_aut" value="" placeholder="Puesto" class="form-control">
          </label>
          <label>Email:
            <input type="text" name="email_aut" value="" placeholder="Email" class="form-control">
          </label>
          <label>Dependencia:
            <select class="form-control" name="sel_depend">
              @foreach ( $select as $item )
                <option value="{{ $item->uuid }}">{{ $item->dependencia }}</option>
              @endforeach
              <option value=""></option>
            </select>
          </label>
          @endif
        </form>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cerrar</a>
        <a href="javascript:;" class="btn btn-sm btn-success" id="add_reg">Guardar cambios</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var id = "",
    data = <?php echo $data ? $data : []; ?>;

  function peticion(filt,data){
    filt = parseInt(filt);
    $.ajax( {
      type: "POST",
      url: "http://localhost:81/Api/<?php echo $met; ?>/"+filt,
      data: data,
      success: function( response ) {
        rs = JSON.parse(response);
        if (rs.success) {
          filt==2 && alert("Se realizaron los cambios");
          window.location.reload();
        }
      }
    } );
  }

  $(".delete").on("click",function(e){
    id = this.id;
  });
  $(document).on("click","#del_yes",function(e){
    peticion(2,"supr=1&sel_depend="+id);
  })

  $(".edit").on("click",function(e){
    id = this.id;
  });

  $("#search_btn").on("click",function(e){
    var idx = $("#search_inp").val();
    window.location.href = "<?php echo Request::url(); ?>/"+idx;
  });

  $("#add_reg").on("click",function(e){
    var form = $("#new_reg").serialize();
    peticion(1,form);
  });

</script>
@stop
