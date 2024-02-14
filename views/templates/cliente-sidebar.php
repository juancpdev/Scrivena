<aside class="dashboard__sidebar dashboard__sidebar--cliente">
    <nav class="dashboard__menu ">
        <a href="/cliente/dashboard" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--cliente--actual' : '';  ?>" >
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <a href="/cliente/contratos" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/contratos') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
            <i class="fa-solid fa-file-contract dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Contratos
            </span>    
        </a>
        
        <a href="/cliente/perfil" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/perfil') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
        <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Mi Perfil
            </span>    
        </a>

    </nav>
</aside>