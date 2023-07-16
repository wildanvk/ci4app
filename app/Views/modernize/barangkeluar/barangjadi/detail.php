<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">Form with view only</h5>
    </div>
    <form class="form-horizontal">
        <div class="form-body">
            <div class="card-body">
                <h5 class="card-title mb-0">Person Info</h5>
            </div>
            <hr class="mt-0 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">First Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">John</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Last Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Doe</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Gender:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Male</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Date of Birth:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">11/06/1987</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Category:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Category1</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Membership:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Free</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <h5 class="mb-0">Address</h5>
            </div>
            <hr class="mt-0 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    E104, Dharti-2, Near silverstar mall
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">City:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Bhavnagar</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">State:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">Gujarat</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Post Code:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">457890</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-end col-md-3">Country:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">India</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-edit fs-5"></i>
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>