    <!-- Modal -->
    <div class="modal fade" id="modalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-short"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" id="edit_contact" data-id="<?=$contact_id?>">Edit</button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center" id="modal_fullname">
                        <?=$contact_fullname?>
                    </h5>
                    <div class="pb-3">
                        <p>Mobile</p>
                        <p class="text-primary" id="modal_mobile">
                            <?=$contact_mobile?>
                        </p>
                    </div>

                    <div class="pb-3">
                        <p>Email</p>
                        <p class="text-primary" id="modal_email">
                            <?=$contact_email?>
                        </p>
                    </div>

                    <div class="pb-3">
                        <p>Company</p>
                        <p class="font-weight-bold" id="modal_company">
                            <?=$contact_company?> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>