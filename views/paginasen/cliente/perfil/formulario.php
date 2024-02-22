<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">1.</span>
        <p class="campo-titulo">Name</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-nombre" 
                type="text" 
                name="nombre" 
                id="nombre" 
                placeholder="Nombre"
                value="<?php echo $usuario->nombre ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">2.</span>
        <p class="campo-titulo">Last name</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-apellido" 
                type="text" 
                name="apellido" 
                id="apellido" 
                placeholder="Apellido"
                value="<?php echo $usuario->apellido ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">3.</span>
        <p class="campo-titulo">E-mail</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-email <?php echo isset($usuario->email) ? "input-desactivado" : ''; ?>" 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Email"
                value="<?php echo isset($usuario->email) ? $usuario->email : ''; ?>"
                <?php echo isset($usuario->email) ? 'readonly' : ''; ?>>
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">5.</span>
        <p class="campo-titulo">Phone</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-telefono" 
                type="number"
                name="telefono" 
                id="telefono" 
                placeholder="Teléfono"
                value="<?php echo $usuario->telefono ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">6.</span>
        <p class="campo-titulo">Country</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-pais" 
                type="text"
                name="pais" 
                id="pais" 
                placeholder="País"
                value="<?php echo $usuario->pais ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">7.</span>
        <p class="campo-titulo">Document</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-documento" 
                type="number"
                name="documento" 
                id="documento" 
                placeholder="Documento"
                value="<?php echo $usuario->documento ?? ''; ?>">
        </div>
    </div>
</div>
