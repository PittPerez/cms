<!-- Modal3 -->
<div class="modal fade" id="Add_Contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-short"></i>
                </button>
                <button type="button" class="btn btn-secondary" id="add_btn" data-id="<?=$contact_id?>"> confirm
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="newName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="tel" class="form-control" id="newMobile" placeholder="Mobile">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="newEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" id="newCompany" placeholder="Company">
                </div>
            </div>
        </div>
    </div>
</div>
