<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">1.</span>
        <p class="campo-titulo">Inversor</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-inversor" type="text" name="inversor" id="inversor" placeholder="Inversor" value="<?php echo $contrato->inversionista_id ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">2.</span>
        <p class="campo-titulo">Monto</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input class="formulario__input input-monto" type="number" name="monto" id="monto" placeholder="Monto de Inversión" value="<?php echo $contrato->inversion ?? ''; ?>">
        </div>
    </div>
</div>

