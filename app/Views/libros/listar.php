<?= $cabecera; ?>

<a class="btn btn-success" href="<?= base_url('/libros/crear') ?>">Crear nuevo libro</a>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($libros as $libro): ?>
        <tr>
            <td> <?= $libro['id']; ?> </td>
            <td> 
                <img src="<?= base_url() .'/storage/'. $libro['img']; ?>" class="img-thumbnail" width="100" alt="">    
            </td>
            <td> <?= $libro['name']; ?> </td>
            <td> 
                <a href="<?= base_url('libro/editar/' . $libro['id']) ?>" >Editar</a> | 
                <a href="<?= base_url('libro/eliminar/' . $libro['id']) ?>" >Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $piePagina; ?>
