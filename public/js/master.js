$(function() {
    const mensaje_error_general = 'Lo sentimos, hubo un problema al actualizar el usuario. Vuelva a intentarlo más tarde.';

    $('.btn-edit').on('click', function() {
        const usuario_id = $(this).attr('data-id');
        let usuario_dto;

        $.ajax({
            url: 'api/usuarios/' + usuario_id,
            async: false,
            success: (response) => usuario_dto = response
        });

        $('#editEmployeeModal form').attr('data-id', usuario_id);
        $('#edit-email').val(usuario_dto.email);
        $('#edit-primer-nombre').val(usuario_dto.primer_nombre);
        $('#edit-segundo-nombre').val(usuario_dto.segundo_nombre);
        $('#edit-primer-apellido').val(usuario_dto.primer_apellido);
        $('#edit-segundo-apellido').val(usuario_dto.segundo_apellido);
        $('#edit-departamento').val(usuario_dto.departamento_id);
        $('#edit-cargo').val(usuario_dto.cargo_id);
    });

    $('#editEmployeeModal form').on('submit', function(event) {
        event.preventDefault();
        
        const usuario_id = $(this).attr('data-id');

        $.ajax({
            url: 'api/usuarios/' + usuario_id,
            type: 'PUT',
            data: {
                'email': $('#edit-email').val(),
                'primer_nombre': $('#edit-primer-nombre').val(),
                'segundo_nombre': $('#edit-segundo-nombre').val(),
                'primer_apellido': $('#edit-primer-apellido').val(),
                'segundo_apellido': $('#edit-segundo-apellido').val(),
                'departamento_id': $('#edit-departamento').val(),
                'cargo_id': $('#edit-cargo').val()
            },
            dataType: 'json',
            success: () => {
                window.location.reload();
            },
            error: (response) => {
                alert(response.responseJSON.error || mensaje_error_general);
                $('#editEmployeeModal').modal('hide');
            }
        });
    });

    $('.btn-delete').on('click', function() {
        const usuario_id = $(this).attr('data-id');

        $.ajax({
            url: 'api/usuarios/' + usuario_id,
            type: 'DELETE',
            success: () => {
                window.location.reload();
            },
            error: () => {
                alert(mensaje_error_general);
            }
        });
    });
});