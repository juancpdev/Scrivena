<aside class="dashboard__sidebar dashboard__sidebar--admin">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace dashboard__enlace--admin <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--admin--actual' : '';  ?>" >
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <a href="/admin/clientes" class="dashboard__enlace dashboard__enlace--admin <?php echo pagina_actual('/clientes') ? 'dashboard__enlace--admin--actual' : '';  ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Clientes
            </span>    
        </a>

        <a href="/admin/contratos" class="dashboard__enlace dashboard__enlace--admin <?php echo pagina_actual('/contratos') ? 'dashboard__enlace--admin--actual' : '';  ?>">
        <i class="fa-solid fa-file-contract dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Contratos
            </span>    
        </a>

    </nav>
</aside>