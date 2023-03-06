<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php foreach ($kode_suplier as $b) : ?>
                <h3>SUPLIER - <?= $b->nama_suplier ?> </h3>
            <?php endforeach; ?>
        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->
</div>