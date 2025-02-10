<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #54B4D3;
            color: white;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div id="toast_container"></div>
    <div class="mx-4">
        <div class="d-flex justify-content-between">
        <h1>Contacts</h1>
        <button type="button" class="btn btn-info rounded-circle my-2" id="create_btn">
            <i class="bi bi-plus-lg"></i>
        </button>
        </div>
        
        <div class="mb-3">
            <input type="text" class="form-control" id="search" aria-label="Amount (to the nearest dollar)">
        </div>

        <br>
        <table class="table table-hover">
            <thead>        
                <th>Name</th>
            </thead>
            <tbody id="user_contacts">

            </tbody>
        </table>
    </div>

    <div id="modal_container"></div>


    <script src="../utilities/js/jquery.js"></script>
    <script src="../utilities//bootstrap/bootstrap.min.js"></script>
    <script src="../utilities/fontawesome/all.min.js"></script>
    <script src="../utilities/sweetalert2/sweetalert2.min.js"></script>
    <script src="../utilities/evo-calendar/js/evo-calendar.js"></script>
    <script src="../utilities/Chart.js/chart.umd.js"></script>
    <script src="../utilities/Print.js/print.min.js"></script>

    <script src="contacts/js/contacts_event_controller.js"></script>
    
</body>
</html>