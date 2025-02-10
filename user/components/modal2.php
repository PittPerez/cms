<!-- Modal2 -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-short"></i>
                </button>
                <button type="button" class="btn btn-secondary" id="done_btn" data-id="<?=$contact_id?>">
                    Confirm
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="newName" placeholder="Name"
                        value="<?=$contact_fullname?>">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="tel" class="form-control" id="newMobile" placeholder="Mobile"
                        value="<?=$contact_mobile?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="newEmail" placeholder="Email"
                        value="<?=$contact_email?>">
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" id="newCompany" placeholder="Company"
                        value="<?=$contact_company?>">
                </div>

                    <button type="button" class="btn btn-warning btn-block" id="delete_btn" data-id="<?= $contact_id ?>">
                        Delete Contact
                    </button>
            </div>
        </div>
    </div>
</div>
