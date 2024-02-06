<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">1.</span>
        <p class="campo-titulo">Inversor</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input type="text" class="formulario__input input-inversor" id="clienteContrato" placeholder="">
            <ul id="listado-clientes" class="listado-clientes"></ul>
            <input type="hidden" name="inversionista_id" value="<?php echo $contrato->inversionista_id; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">2.</span>
        <p class="campo-titulo">Inversión</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-inversion" type="number" name="inversion" id="inversion" placeholder="Monto de Inversión" value="<?php echo $contrato->inversion ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">3.</span>
        <p class="campo-titulo">Tipo de inversión</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <select name="tipo" id="tipo">
                <option selected value="" disabled>-- Seleccione --</option>
                <?php foreach ($tipos_inversion as $tipo) { ?>
                    <option <?php echo $contrato->tipo === $tipo ? 'selected' : '';  ?>>
                        <?php echo $tipo; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>


<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">4.</span>
        <p class="campo-titulo">Fecha de inicio</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-inicio" type="date" name="fecha_inicio" id="fechainicio" placeholder="Fecha de inicio de Inversión" value="<?php echo $contrato->fecha_inicio ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">5.</span>
        <p class="campo-titulo">Fecha de Finalización</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-finalizacion" type="date" name="fecha_fin" id="fechafin" placeholder="Fecha de finalización de Inversión" value="<?php echo $contrato->fecha_fin ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">6.</span>
        <p class="campo-titulo">Contrato</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-contrato" type="file" name="contrato" id="contrato" accept=".doc, .docx, .pdf">
        </div>
    </div>

    <?php if ($contrato->contrato && basename($_SERVER['REQUEST_URI']) !== 'crear') { ?>
        <div class="contrato--actual-contenedor">
            <a class="contrato--actual" href="/contratos/<?php echo $contrato->contrato ?>" target="_blank">
                <i class="fa-solid fa-file-contract"></i>
                Contrato Actual
            </a>
        </div>
    <?php } ?>
</div>