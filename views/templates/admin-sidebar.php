<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : '';  ?>" >
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <a href="/admin/clientes" class="dashboard__enlace <?php echo pagina_actual('/clientes') ? 'dashboard__enlace--actual' : '';  ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Clientes
            </span>    
        </a>

    </nav>
</aside>