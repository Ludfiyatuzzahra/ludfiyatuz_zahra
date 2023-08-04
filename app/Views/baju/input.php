<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>

            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5><i class="icon fas fa-ban"></i>Alert!</h5>
                            <?php echo validation_list_errors(); ?>
                        </div>
                    <?php
                    } ?>
                    <?php
                    if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5><i class="fa-solid fa-circle-exclamation"></i> Error</h5>
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php
                    } ?>
                    <?php echo csrf_field(); ?>
                    <?php
                    if (current_url(true)->getSegment(2) == 'edit') {
                    ?>
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_baju']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="id_baju">id Baju</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('id_baju')) ? (empty($edit_data['id_baju']) ? "" : $edit_data['id_baju']) : set_value('id_baju'); ?>" id="id_baju" name="id_baju">
                    </div>
                    <div class="form-group">
                        <label for="judul_baju">Judul Baju</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('judul_baju')) ? (empty($edit_data['judul_baju']) ? "" : $edit_data['judul_baju']) : set_value('judul_baju'); ?>" id="judul_baju" name="judul_baju">
                    </div>
                    <div class="form-group">
                        <label for="harga_baju">Harga Baju</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('harga_baju')) ? (empty($edit_data['harga_baju']) ? "" : $edit_data['harga_baju']) : set_value('harga_baju'); ?>" id="harga_baju" name="harga_baju">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('stok')) ? (empty($edit_data['stok']) ? "" : $edit_data['stok']) : set_value('stok'); ?>" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" value="<?php echo empty(set_value('kategori')) ? (empty($edit_data['kategori']) ? "" : $edit_data['kategori']) : set_value('kategori'); ?>" id="kategori" name="kategori">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                        <a class="btn btn-danger float-right" href="javascript:history.back()"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <?php
    echo $this->endSection();
