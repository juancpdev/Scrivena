<aside class="dashboard__sidebar dashboard__sidebar--cliente">
    <nav class="dashboard__menu ">
        <a href="/client/dashboard?lang=en" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--cliente--actual' : '';  ?>" >
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Home
            </span>    
        </a>

        <a href="/client/contracts?lang=en" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/contracts') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
            <i class="fa-solid fa-file-contract dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Contracts
            </span>    
        </a>
        
        <a href="/client/profile?lang=en" class="dashboard__enlace dashboard__enlace--cliente <?php echo pagina_actual('/profile') ? 'dashboard__enlace--cliente--actual' : '';  ?>">
        <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                My profile
            </span>    
        </a>

    </nav>
</aside>