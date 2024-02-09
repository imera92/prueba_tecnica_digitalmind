@extends('layout.master')

@section('title', 'Prueba Técnica - Administrador de Usuarios')

@push('extra_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/crud_usuarios.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administracion de Usuarios</h2>
                    </div>
                    <div class="col-sm-6">
                        <a id="add-user-modal-btn" href="#addUserModal" class="btn btn-success" data-toggle="modal">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Añadir usuario
                        </a>
                    </div>
                </div>
            </div>
            @if($usuarios->count() > 0)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Departamento</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }}</td>
                                <td>{{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</td>
                                <td>{{ $usuario->departamento->nombre }}</td>
                                <td>{{ $usuario->cargo->nombre }}</td>
                                <td>
                                    <a href="#editUserModal" class="btn btn-default btn-edit" data-toggle="modal" data-id="{{ $usuario->id }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button type="button" class="btn btn-default btn-delete" aria-label="Left Align" data-id="{{ $usuario->id }}">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Total de registros: <b>{{ $usuarios->count() }}</b></div>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal Crear -->
    <div id="addUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email:</label>
                            <input id="add-email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Primer nombre:</label>
                            <input id="add-primer-nombre" type="text" class="form-control" name="primer_nombre" required>
                        </div>
                        <div class="form-group">
                            <label>Segundo nombre:</label>
                            <input id="add-segundo-nombre" type="text" class="form-control" name="segundo_nombre">
                        </div>
                        <div class="form-group">
                            <label>Primer apellido:</label>
                            <input id="add-primer-apellido" type="text" class="form-control" name="primer_apellido" required>
                        </div>
                        <div class="form-group">
                            <label>Segundo apellido:</label>
                            <input id="add-segundo-apellido" type="text" class="form-control" name="segundo_apellido">
                        </div>
                        <div class="form-group">
                            <label>Departamento:</label>
                            <select id="add-departamento" class="form-control" name="departamento_id" required>
                                <option value="" disabled selected>Escoja una opcion</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cargo:</label>
                            <select id="add-cargo" class="form-control" name="cargo_id" required>
                                <option value="" disabled selected>Escoja una opcion</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-info" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edicion -->
    <div id="editUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form data-id="">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email:</label>
                            <input id="edit-email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Primer nombre:</label>
                            <input id="edit-primer-nombre" type="text" class="form-control" name="primer_nombre" required>
                        </div>
                        <div class="form-group">
                            <label>Segundo nombre:</label>
                            <input id="edit-segundo-nombre" type="text" class="form-control" name="segundo_nombre">
                        </div>
                        <div class="form-group">
                            <label>Primer apellido:</label>
                            <input id="edit-primer-apellido" type="text" class="form-control" name="primer_apellido" required>
                        </div>
                        <div class="form-group">
                            <label>Segundo apellido:</label>
                            <input id="edit-segundo-apellido" type="text" class="form-control" name="segundo_apellido">
                        </div>
                        <div class="form-group">
                            <label>Departamento:</label>
                            <select id="edit-departamento" class="form-control" name="departamento_id" required>
                                <option value="" disabled selected>Escoja una opcion</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cargo:</label>
                            <select id="edit-cargo" class="form-control" name="cargo_id" required>
                                <option value="" disabled selected>Escoja una opcion</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-info" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection