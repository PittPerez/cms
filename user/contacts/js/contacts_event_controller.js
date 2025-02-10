$(document).ready(function () {
    fetch_all_contacts();
})


function fetch_all_contacts() {
    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'fetch_all_contacts'
    }, function (data) {    
        var response = JSON.parse(data);
        if (response.status == 'success') {
            $('#user_contacts').html(response.view);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        }
    });
}

$(document).on('hidden.bs.modal', '#modalinfo', function () {
    $('#modalinfo').modal('hide');
    $('#modalinfo').remove();
    $('.modal-backdrop').remove();
});

$(document).on('hidden.bs.modal', '#editmodal', function () {
    $('#editmodal').modal('hide');
    $('#editmodal').remove();
    $('.modal-backdrop').remove();
});


$(document).on("keyup", function (e) {
    var busqueda = $('#search').val();

    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'search_user_contacts',
        busquedaNombre: busqueda
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success') {
        $('#user_contacts').html(response.view);
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        }
    });
});

$(document).on("click", ".contact-row", function () {
    var contactId = $(this).data("id");

    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'contact_details',
        contact_id: contactId
    }, function (data) {    
        var response = JSON.parse(data);
        if (response.status == 'success') {
            $("#modal_container").html(response.view);
            $("#modalinfo").modal("show");
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        } 
    });
    
});

$(document).on("click", "#edit_contact", function () {
    var contactId = $(this).data("id");

    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'contact_edit_details',
        contact_id: contactId
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success'){
            $("#modalinfo").modal("hide");
            $("#modal_container").html(response.view);
            $("#editmodal").modal("show");
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        } 
    });
});

$(document).on("click", "#done_btn", function () {
    var contactId = $(this).data("id");
    console.log("Contact ID:", contactId);

    var newName = $("#newName").val();
    var newMobile = $("#newMobile").val();
    var newEmail = $("#newEmail").val();
    var newCompany = $("#newCompany").val();

    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'update_contact',
        contact_id: contactId,
        contact_fullname: newName,
        contact_mobile: newMobile,
        contact_email: newEmail,
        contact_company: newCompany
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success'){
            $("#modal_container").html(response.view);
            $("#modalinfo").modal("show");
            fetch_all_contacts();
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        } 
    });
});

$(document).on("click", "#delete_btn", function () {
    var contactId = $(this).data("id");
    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'delete_contacts',
        contact_id: contactId
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success'){
            fetch_all_contacts();
            $('#editmodal').modal("hide");
            $("#toast_container").html(response.view);
            $('#toast_delete_user').toast("show");
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        } 
    });
});

$(document).on("click", "#create_btn", function () {
    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'create_contact_modal'
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success'){
            $("#modal_container").html(response.view);
            $("#Add_Contact").modal("show");
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        }   
    });
});

// Guardar nuevo contacto
$(document).on("click", "#add_btn", function () {
    var contactId = $(this).data("id");

    var newName = $("#newName").val();
    var newMobile = $("#newMobile").val();
    var newEmail = $("#newEmail").val();
    var newCompany = $("#newCompany").val();
    //intento img
    var newImg = $("#newImg").val();

    $.post('contacts/controller/contacts_controller.php', {
        user_request: 'save_new_contact',
        contact_id: contactId,
        contact_fullname: newName,
        contact_mobile: newMobile,
        contact_email: newEmail,
        contact_company: newCompany,
        image_user: newImg
    }, function (data) {
        var response = JSON.parse(data);
        if (response.status == 'success'){
            fetch_all_contacts();
            $('#Add_Contact').modal("hide");
            $("#toast_container").html(response.view);
            $('#toast_create_user').toast("show");
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        }  
    });
});
