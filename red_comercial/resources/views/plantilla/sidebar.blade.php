<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li @click="menu=0" class="nav-item active">
            <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Secciones</li>
            <li @click="menu=1"><a class="nav-link" href="#"><i class="fas fa-pencil-ruler"></i> <span>Categorías</span></a></li>
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Usuario</span></a>
            <ul class="dropdown-menu">
                <li @click="menu=2"><a class="nav-link" href="#">Listado de usuarios</a></li>
                <li @click="menu=3"><a class="nav-link" href="#">Roles</a></li>
            </ul>
            </li>
        
            <li class="menu-header">Usuarios</li>
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Forgot Password</a></li>
                <li><a href="#">Login</a></li>
                <li><a class="beep beep-sidebar" href="#">Login 2</a></li>
                <li><a href="#">Register</a></li>
                <li><a href="#">Reset Password</a></li>
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