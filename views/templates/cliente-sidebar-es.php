<aside class="dashboard__sidebar dashboard__sidebar--cliente">
    <nav class="dashboard__menu ">
        <a href="/cliente/panel?lang=es" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/panel') ? 'dashboard__enlace--cliente--actual' : '';  ?>" >
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <a href="/cliente/contratos?lang=es" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/contratos') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
            <i class="fa-solid fa-file-contract dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Contratos
            </span>    
        </a>
        
        <a href="/cliente/perfil?lang=es" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/perfil') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
        <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Mi Perfil
            </span>    
        </a>

    </nav>
</aside>