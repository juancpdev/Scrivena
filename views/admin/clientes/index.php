<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/admin/clientes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Cliente
    </a>
</div>

<div class="dashboard__contenedor--clientes">
    <?php if (count($clientes) > 1) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <th scope="col" class="table__th table__th--id">ID</th>
                    <th scope="col" class="table__th table__th--nombre">Nombre</th>
                    <th scope="col" class="table__th table__th--email">E-mail</th>
                    <th scope="col" class="table__th table__th--documento">Documento</th>
                    <th scope="col" class="table__th table__th--pais">País</th>
                    <th scope="col" class="table__th table__th--telefono">Teléfono</th>
                    <th scope="col" class="table__th"></th>
                </tr> 
            </thead>

            <tbody class="table__tbody">
                <?php foreach($clientes as $cliente) { ?>
                    <?php if($cliente->admin === "0") { ?>
                    <tr class="table__tr table__tr--body table__tr--colores">
                        <td class="table__td table__td--id">
                            <?php echo $cliente->id; ?>
                        </td>
                        <td class="table__td table__td--nombre">
                            <?php echo $cliente->nombre . " " . $cliente->apellido; ?>
                        </td>
                        <td class="table__td table__td--email">
                            <?php echo $cliente->email ?>
                        </td>
                        <td class="table__td table__td--documento">
                            <?php echo $cliente->documento ?>
                        </td>
                        <td class="table__td table__td--pais">
                            <?php echo $cliente->pais ?>
                        </td>
                        <td class="table__td table__td--telefono">
                            <?php echo $cliente->telefono ?>
                        </td>
                        
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/clientes/editar?id=<?php echo $cliente->id; ?>">
                                <i class="fa-solid fa-user-pen table__accion--icono"></i>
                            </a>
                            <form class="table__formulario" method="POST" action="/admin/clientes/eliminar" id="formEliminarCliente-<?php echo $cliente->id; ?>" >
                                <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                                <button 
                                    class="table__accion table__accion--eliminar" 
                                    type="submit" 
                                    onclick="confirmDelete(event,'formEliminarCliente-<?php echo $cliente->id; ?>')"
                                    >
                                    <i class="fa-solid fa-trash table__accion--icono"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
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
