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
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-ruler"></i> <span>Productos</span></a>
                <ul class="dropdown-menu">
                    <li @click="menu=1"><a class="nav-link" href="#">Categorías</a></li>
                    <li @click="menu=4"><a class="nav-link" href="#">Etiquetas</a></li>
                    <li @click="menu=6"><a class="nav-link" href="#">Listado de servicios</a></li>
                    <li @click="menu=7"><a class="nav-link" href="#">Listado de productos</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Usuario</span></a>
                <ul class="dropdown-menu">
                    <li @click="menu=2"><a class="nav-link" href="#">Listado de usuarios</a></li>
                    <li @click="menu=3"><a class="nav-link" href="#">Roles</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-images"></i> <span>Medios</span></a>
                <ul class="dropdown-menu">
                    <li @click="menu=5"><a class="nav-link" href="#">Galería</a></li>
                    <li ><a class="nav-link" href="#">Documentos</a></li>
                </ul>
            </li>
        
            
            <li><a class="nav-link" href="#"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>