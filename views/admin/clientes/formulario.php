<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">1.</span>
        <p class="campo-titulo">Nombre</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-nombre" 
                type="text" 
                name="nombre" 
                id="nombre" 
                placeholder="Nombre"
                value="<?php echo $cliente->nombre ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">2.</span>
        <p class="campo-titulo">Apellido</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-apellido" 
                type="text" 
                name="apellido" 
                id="apellido" 
                placeholder="Apellido"
                value="<?php echo $cliente->apellido ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">3.</span>
        <p class="campo-titulo">Email</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-email" 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Email"
                value="<?php echo $cliente->email ?? ''; ?>">
        </div>
    </div>
</div>

<div class="campo-contenedor">
    <div class="campo_contenedor-arriba">
        <span class="campo-orden">4.</span>
        <p class="campo-titulo">Password</p>
    </div>
    <div class="campo_contenedor-abajo">
        <div class="campo">
            <input 
                class="formulario__input input-password" 
                type="password"
                name="password" 
                id="password" 
                placeholder="Password"
                value="<?php echo $cliente->password ?? ''; ?>">
        </div>
    </div>
</div>
