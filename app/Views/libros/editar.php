<?= $cabecera; ?>

<a href="<?= base_url('/libros/listar') ?>"></a>
<div>
    <h2>Form crear libro</h2>
    <div class="card">
        <div class="card-body">            
            <div class="card-title">
                <h5>Edita datos del libro</h5>
            </div>         
            <div class="card-text">
                <form method="POST" action="<?= site_url('/libro/actualizar') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $libro['id']; ?>">
                    <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" value="<?= $libro['name']; ?>" name="nombre" id="nombre" class="form-control" placeholder="Escriba un nombre" >
                    </div>
                    <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file" name="imagen" id="imagen" >
                    <img src="<?= base_url() .'/storage/'. $libro['img']; ?>" class="img-thumbnail" width="100" alt="">    

                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>

</div>
<?= $piePagina; ?>
