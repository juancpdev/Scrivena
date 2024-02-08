<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/admin/contratos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Contrato
    </a>
</div>

<div class="dashboard__contenedor--contratos">
    <?php if (!empty($contratos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <th scope="col" class="table__th table__th--id">ID</th>
                    <th scope="col" class="table__th table__th--inversor">Inversor</th>
                    <th scope="col" class="table__th table__th--monto">Monto</th>
                    <th scope="col" class="table__th table__th--tipo">Tipo</th>
                    <th scope="col" class="table__th table__th--inicio">Inicio</th>
                    <th scope="col" class="table__th table__th--finalizacion">Finalización</th>
                    <th scope="col" class="table__th table__th--contrato">Contrato</th>
                    <th scope="col" class="table__th table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php
                foreach ($contratos as $contrato) {
                    // Convertir la fecha de finalización del contrato a timestamp
                    $fecha_fin_timestamp = strtotime($contrato->fecha_fin);
                    // Obtener el tiempo actual en timestamp
                    $tiempo_actual_timestamp = time();
                    // Verificar si la fecha de finalización ha pasado
                    $fecha_fin_pasada = $fecha_fin_timestamp < $tiempo_actual_timestamp;
                    // Agregar una clase condicional según si la fecha de finalización ha pasado o no
                    $clase_fecha_pasada = $fecha_fin_pasada ? 'fecha-pasada' : '';
                ?>
                    <tr class="table__tr table__tr--body <?php echo $clase_fecha_pasada; ?>">
                        <td class="table__td table__td--id">
                            <?php echo $contrato->id; ?>
                        </td>
                        <td class="table__td table__td--inversor">
                            <?php echo $contrato->inversionista->nombre . " " . $contrato->inversionista->apellido ?>
                        </td>
                        <td class="table__td table__td--monto">
                            $<?php echo $contrato->inversion ?>
                        </td>
                        <td class="table__td table__td--tipo">
                            <?php echo $contrato->tipo ?>
                        </td>
                        <td class="table__td table__td--inicio">
                            <?php echo date("d/m/Y", strtotime($contrato->fecha_inicio)); ?>
                        </td>
                        <td class="table__td table__td--finalizacion">
                            <?php echo date("d/m/Y", strtotime($contrato->fecha_fin)); ?>
                        </td>
                        <td class="table__td table__td--contrato">

                            <a class="contrato--actual" href="/contratos/<?php echo $contrato->contrato ?>" target="_blank">
                                <i class="fa-solid fa-file-contract"></i>
                                Ver Contrato
                            </a>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/contratos/editar?id=<?php echo $contrato->id; ?>">
                                <i class="fa-solid fa-user-pen table__accion--icono"></i>Editar
                            </a>
                            <form class="table__formulario" method="POST" action="/admin/contratos/eliminar" id="formEliminarContrato-<?php echo $contrato->id; ?>">
                                <input type="hidden" name="id" value="<?php echo $contrato->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit" onclick="confirmDelete(event,'formEliminarContrato-<?php echo $contrato->id; ?>')">
                                    <i class="fa-solid fa-circle-xmark table__accion--icono"></i>Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No Hay Contratos Aún</p>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>