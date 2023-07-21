var tombol =
      '<div class="btn-group">' +
      '<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-edit-' +
      response.data.idSupplier +
      '">' +
      '    <i class="ti ti-edit"></i>' +
      "    Update" +
      "</button>" +
      '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-' +
      response.data.idSupplier +
      '">' +
      '<i class="ti ti-trash"></i> Hapus' +
      "</button>" +
      "</div>";

    var modalEdit =
      '<div class="modal fade" id="modal-edit-' +
      response.data.idSupplier +
      '" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">' +
      '    <div class="modal-dialog modal-dialog-centered">' +
      '        <div class="modal-content update-modal">' +
      '            <form id="updateSupplierForm-' +
      response.data.idSupplier +
      '" action="" method="post">' +
      "                <?= csrf_field() ?>" +
      '                <div class="modal-header modal-colored-header bg-info d-flex align-items-center">' +
      '                    <h4 class="modal-title" id="myLargeModalLabel">' +
      "                        Update Data" +
      "                    </h4>" +
      '                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
      "                </div>" +
      '                <div class="modal-body" style="text-align: left !important;">' +
      '                    <div class="row">' +
      '                        <div class="form-group">' +
      '                            <div class="mb-3">' +
      '                                <label for="idSupplier" class="form-label fw-semibold col-form-label ms-1">ID Supplier :</label>' +
      '                                <input type="text" class="form-control" id="idSupplier" placeholder="Masukkan ID Supplier" name="idSupplier" value="' +
      response.data.idSupplier +
      '" readonly>' +
      '                                <div class="invalid-feedback"></div>' +
      "                            </div>" +
      '                            <div class="mb-3">' +
      '                                <label for="namaSupplier" class="form-label fw-semibold col-form-label ms-1">Nama Supplier :</label>' +
      '                                <input type="text" class="form-control" id="namaSupplier" placeholder="Masukkan Nama Supplier" name="namaSupplier" value="' +
      response.data.namaSupplier +
      '">' +
      '                                <div class="invalid-feedback"></div>' +
      "                            </div>" +
      '                            <div class="mb-3">' +
      '                                <label for="alamat" class="form-label fw-semibold col-form-label ms-1">Alamat Supplier :</label>' +
      '                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat Supplier" name="alamat" value="' +
      response.data.alamat +
      '">' +
      '                                <div class="invalid-feedback"></div>' +
      "                            </div>" +
      '                            <div class="mb-3">' +
      '                                <label for="kontak" class="form-label fw-semibold col-form-label ms-1">Kontak Supplier :</label>' +
      '                                <input type="text" class="form-control" id="kontak" placeholder="Masukkan Kontak Supplier" name="kontak" value="' +
      response.data.kontak +
      '">' +
      '                                <div class="invalid-feedback"></div>' +
      "                            </div>" +
      '                            <div class="mb-3">' +
      '                                <label for="status" class="form-label fw-semibold col-form-label ms-1">Status :</label>' +
      '                                <select class="form-select" name="status" id="status">' +
      '                                    <option value="">Pilih Status</option>' +
      '                                    <option value="Active"' +
      (response.data.status == "Active" ? " selected" : "") +
      ">Active</option>" +
      '                                    <option value="Inactive"' +
      (response.data.status == "Inactive" ? " selected" : "") +
      ">Inactive</option>" +
      "                                </select>" +
      '                                <div class="invalid-feedback"></div>' +
      "                            </div>" +
      "                        </div>" +
      "                    </div>" +
      "                </div>" +
      '                <div class="modal-footer">' +
      '                    <button type="submit" class="btn btn-light-info text-info font-medium">' +
      "                        Update Data" +
      "                    </button>" +
      '                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">' +
      "                        Close" +
      "                    </button>" +
      "                </div>" +
      "            </form>" +
      "        </div>" +
      "    </div>" +
      "</div>";

    var modalHapus =
      "<!-- Modal Hapus -->" +
      '<div class="modal fade" id="modal-' +
      response.data.idSupplier +
      '" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">' +
      '    <div class="modal-dialog modal-dialog-centered">' +
      '        <div class="modal-content">' +
      '            <div class="modal-header modal-colored-header bg-danger d-flex align-items-center">' +
      '                <h4 class="modal-title" id="myLargeModalLabel">' +
      "                    Hapus Data" +
      "                </h4>" +
      '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
      "            </div>" +
      '            <div class="modal-body text-wrap">' +
      '                <p class="fw-medium fs-4" style="text-align: left !important; line-height: 2em; !important">' +
      "                    Apakah Anda yakin ingin menghapus data supplier" +
      '                    <span class="badge bg-primary">' +
      response.data.idSupplier +
      "</span>" +
      "                    dengan nama supplier" +
      '                    <span class="badge bg-primary">' +
      response.data.namaSupplier +
      "</span>" +
      "                </p>" +
      "            </div>" +
      '            <div class="modal-footer">' +
      '                <a href="' +
      baseUrl +
      "/supplier/delete" +
      response.data.idSupplier +
      '" class="btn btn-light-danger text-danger font-medium">' +
      "                    Hapus Data" +
      "                </a>" +
      '                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">' +
      "                    Close" +
      "                </button>" +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>";