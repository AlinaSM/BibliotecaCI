<?= $cabecera; ?>

<?php if(session('mensaje')){ ?>
    <div class="alert alert-danger" role="alert">
        <h5><?= session('mensaje') ?></h5>
    </div>
<?php } ?>

<a href="<?= base_url('/libros/listar') ?>"></a>
<div>
    <h2>Crear libro</h2>
    <div class="card">
        <div class="card-body">            
            <div class="card-title">
                <h5>Ingresar datos del libro</h5>
            </div>         
            <div class="card-text">
                <form method="POST" action="<?= site_url('/libros/guardar') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?= old('nombre') ?>" id="nombre" class="form-control" placeholder="Escriba un nombre" >
                    </div>
                    <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file" name="imagen" id="imagen" >
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>

</div>
<?= $piePagina; ?>
