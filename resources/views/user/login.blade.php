@extends('layout')

@section('content')
<div class="col-md-12">
  <form class="form-group" action="login" method="post">
    <label>Usuario:
      <input type="text" name="usr" id="usr" class="form-control" value="" required>
    </label>
    <label>Contraseña:
      <input type="password" name="pass" id="pass" class="form-control" value="" required>
    </label>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" name="button" class="btn btn-info">Ingresar</button>
  </form>
</div>
@stop                                                                                                                                                                                                                                                                                                                                                                                      
