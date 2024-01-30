<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre Cliente"
            value="<?php echo $cliente->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input
            type="text"
            class="formulario__input"
            id="apellido"
            name="apellido"
            placeholder="Apellido Cliente"
            value="<?php echo $cliente->apellido ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">E-mail</label>
        <input
            type="email"
            class="formulario__input"
            id="email"
            name="email"
            placeholder="E-mail Cliente"
            value="<?php echo $cliente->email ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">Password</label>
        <input
            type="password"
            class="formulario__input"
            id="password"
            name="password"
            placeholder="Password Cliente"
            value="<?php echo $cliente->password ?? ''; ?>"
        >
    </div>

</fieldset>
