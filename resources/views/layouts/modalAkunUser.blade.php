@section('modal_content_settingAkun')
    <div class="modal-content">
        <div class="modal-header crd-header py-3">
            <p class="text-primary m-0 fw-bold">Perbaharui Data Pribadi</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Data Akun
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form>
                                <ul id="updateform_errList"></ul>
                                <div class="row">
                                    <input type="hidden" id="settingAkun_DAkun_id">
                                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                                Akun</strong></label><input class="form-control" placeholder=""
                                            type="text" id="settingAkun_namaAkun" name="" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3"><label class="form-label"
                                                for="city"><strong>Username</strong></label><input class="form-control"
                                                placeholder="Boleh Kosong" type="text" id="settingAkun_username" name=""
                                                disabled></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3"><label class="form-label" for="city"><strong>No
                                                    HP</strong></label><input class="form-control"
                                                placeholder="Boleh Kosong" type="text" id="settingAkun_noHpAkun" name=""
                                                disabled></div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3"><label class="form-label" for="city"><strong>Tipe
                                                    Akun</strong></label>
                                            <select class="custom-select" disabled>
                                                <option value="" id="settingAkun_kategoriAkun" selected></option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg">
                                    <div class="mb-3"><label class="form-label" for="country"><strong>
                                                Terakhir Diperbaharui</strong></label><input class="form-control" type="date"
                                            id="edit_lu" placeholder="dd/mm/yyyy">
                                    </div>
                                </div> --}}
                                </div>
                                <div class="mb-3"><label class="form-label" for="city"><strong>Alamat
                                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong"
                                        type="text" id="settingAkun_alamatAkun" name="" disabled> </textarea></div>
                            </form>
                            <button id="" type="button" class="btn btn-primary mt-3" disabled>Update Data</button>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Ubah Kata Sandi
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="">
                                <ul id="updateform_errListPassword"></ul>
                                <div class="row">
                                    <input type="hidden" id="settingAkun_DAkun_id">
                                    <div class="mb-3"><label class="form-label" for="city"><strong>Kata Sandi
                                                Baru</strong></label><input class="form-control" placeholder=""
                                            type="password" id="settingAkun_password" name=""></div>
                                </div>
                                <div class="row">
                                    <div class="mb-3"><label class="form-label" for="city"><strong>Kata Sandi
                                                Baru Sekali Lagi</strong></label><input class="form-control"
                                            placeholder="" type="password" id="settingAkun_passwordConfirm" name=""></div>
                                </div>
                            </form>
                            <button id="update_passwordSettingsAkunBtn" type="button" class="btn btn-primary">Update
                                Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button id="update_akunBtn" type="button" class="btn btn-primary">Update Data</button> --}}
        </div>
    </div>
@endsection
