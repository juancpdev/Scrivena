<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/admin/clientes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Cliente
    </a>
</div>

<div class="dashboard__contenedor--clientes">
    <?php if(!empty($clientes)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">E-mail</th>
                    <th scope="col" class="table__th"></th>
                </tr> 
            </thead>

            <tbody class="table__tbody">
                <?php foreach($clientes as $cliente) { ?>
                    <tr class="table__tr table__tr--body">
                        <td class="table__td">
                            <?php echo $cliente->nombre . " " . $cliente->apellido; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $cliente->email ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/clientes/editar?id=<?php echo $cliente->id; ?>">
                                <i class="fa-solid fa-user-pen table__accion--icono"></i>Editar
                            </a>
                            <form class="table__formulario" method="POST" action="/admin/clientes/eliminar" id="formEliminarPonente-<?php echo $cliente->id; ?>" >
                                <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                                <button 
                                    class="table__accion table__accion--eliminar" 
                                    type="submit" 
                                    onclick="confirmDelete(event,'formEliminarCliente-<?php echo $cliente->id; ?>')"
                                    >
                                        <i class="fa-solid fa-circle-xmark table__accion--icono"></i>Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No Hay Clientes Aún</p>
    <?php } ?>
</div>

<?php 
    echo $paginacion; 
?>
