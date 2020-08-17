<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <?php echo '<img src="'.Auth::user()->image_profile.'" alt="Escoge una imagen" width="52px" class="rounded-circle profile-widget-picture">' ?>
         </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <?php echo '<img src="'.Auth::user()->image_profile.'" alt="Escoge una imagen" width="52px" class="rounded-circle profile-widget-picture">' ?>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li @click="menu=0" class="nav-item active">
            <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Secciones</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-ruler"></i> <span>Administración</span></a>
                <ul class="dropdown-menu">
                    <li @click="menu=1"><a class="nav-link" href="#">Facturas</a></li>
                    <li @click="menu=2"><a class="nav-link" href="#">Reportes</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Usuarios y sociedades</span></a>
                <ul class="dropdown-menu">
                    <li @click="menu=3"><a class="nav-link" href="#">Listado de usuarios</a></li>
                    <li @click="menu=4"><a class="nav-link" href="#">Listado de sociedades</a></li>
                </ul>
            </li>
        
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>