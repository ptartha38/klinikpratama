<div class="card">
    <div class="card-body">
        <div class="mx-auto d-block">
            <img width="90px" class="rounded-circle mx-auto d-block" src="<?= base_url() ?>/assets/img/foto_profil/<?= $session->foto; ?>" alt="Card image cap">
            <h5 class="text-sm-center mt-2 mb-1"><?= $session->nama_lengkap; ?></h5>
            <div class="location text-sm-center">
                <i class="fa fa-map-marker"></i> <?= $session->alamat; ?>
            </div>
        </div>
        <hr>
        <div class="card-text text-sm-center">
            <p>Vaksin Pertama Tanggal :</p>
            <p>Vaksin Kedua Tanggal :</p>
        </div>
    </div>
    <div class="card-footer">
        <strong class="card-title mb-3">Vaksinasi Covid - 19 di Klinik Pratama Polres Sumbawa</strong>
    </div>
</div>

<script>
    <?php if (session()->getFlashdata('sukses')) { ?>
        Swal.fire(
            'Selamat',
            '<?php echo $session->sukses ?>',
            'success'
        )
    <?php } ?>
</script>