<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times; </button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">

                    <input type="date" name="tanggal" placeholder="Tanggal" class="form-control" required> <br>

                    <label for="airlines">Airline</label> <br>

                    <select name="airlines" id="airlines">
                        <option value="APK">APK</option>
                        <option value="Batik Air">Batik Air</option>
                        <option value="Citilink Indonesia">Citilink Indonesia</option>
                        <option value="Gapura">Gapura</option>
                        <option value="Garuda Indonesia">Garuda Indonesia</option>
                        <option value="Lion Air">Lion Air</option>
                        <option value="Nam Air">Nam Air</option>
                        <option value="PT Smart Cakrawala Aviation">PT Smart Cakrawala Aviation</option>
                        <option value="Sriwijaya">Sriwijaya</option>
                        <option value="Super Jet">Super Jet</option>
                        <option value="Wings Air">Wings Air</option>
                        <option value="Angkasa Super">PT Angkasa Super Service</option>
                        <option value="PT Transnusa Aviation Mandiri ">PT Transnusa Aviation Mandiri </option>
                        <option value="PT Sayap Garuda Indah">PT Sayap Garuda Indah</option>
                        <option value="PT Indonesia Air">PT Indonesia Air</option>
                        <option value="PT Integrasi Aviasi Solusi">PT Integrasi Aviasi Solusi</option>
                        <option value="PT Wira Adirajasa Dirgantara">PT Wira Adirajasa Dirgantara</option>
                        <option value="PT ERSA EASTERN AVIATION">PT ERSA EASTERN AVIATION</option>
                        <option value="PT JURAGAN 99 AVIASI">PT JURAGAN 99 AVIASI</option>
                        <option value="PT KARISMA BAHANA AVIASI">PT KARISMA BAHANA AVIASI</option>
                        <option value="PT PELITA AIR SERVICE">PT PELITA AIR SERVICE</option>
                    </select> <br> <br>

                    <!-- <input type="text" name="pembukuan" placeholder="Pembukuan" class="form-control" required> <br> -->
                    
                    <label for="pembukuan">Pembukuan</label> <br>

                    <select name="pembukuan" id="pembukuan">
                        <option value="MCA APK">MCA APK</option>
                        <option value="MCA CARTER">MCA CARTER</option>
                        <option value="MCA PKY">MCA PKY</option>
                        <option value="MCA PNK">MCA PNK</option>
                        <option value="MCA SKJ">MCA SKJ</option>
                        <option value="Mulio Sampit">Mulio Sampit</option>
                        <option value="IAS">IAS</option>
                    </select> <br> <br>

                    <label for="type">Tipe</label> <br>

                    <select name="type" id="type">
                        <option value="Charter">Charter</option>
                        <option value="Ground Handling">Ground Handling</option>
                        <option value="GSE">GSE</option>
                        <option value="Gudang">Gudang</option>
                        <option value="GH RON">GH Round</option>
                        <option value="Profit Sharing">Profit Sharing</option>
                        <option value="Pajak (PPH 23)">Pajak (PPH 23)</option>
                        <option value="Revenue Sharing">Revenue Sharing</option>
                    </select> <br> <br>

                    <input type="number" name="tagihan" placeholder="Tagihan" class="form-control" required> <br>
                    <input type="number" step="0.1" name="ppn" placeholder="PPN (%)" class="form-control" required> <br>
                    <input type="number" step="0.1" name="konsesi" placeholder="Konsesi (%)" class="form-control" required> <br>
                    <input type="number" step="0.1" name="pph" placeholder="PPH (%)" class="form-control" required> <br>
                    <input type="number" name="cicilan" placeholder="Cicilan" class="form-control" required> <br>

                    <button type="submit" class="btn btn-primary" name="submitdata">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New User Modal -->
<div class="modal fade" id="newAdmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Admin</h4>
                <button type="button" class="close" data-dismiss="modal">&times; </button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">

                    <input type="text" name="username" placeholder="Username" class="form-control" required> <br>
                    <input type="password" name="passwd" placeholder="Password" class="form-control" required> <br>

                    <button type="submit" class="btn btn-primary" name="newuserdata">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

