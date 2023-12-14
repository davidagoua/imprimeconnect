<div class="main-sidebar bg-dark sidebar-style-2" >
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html" class=" text-white">{{ config('APP_NAME', 'ImprimeConnect') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm bg-dark text-white">
            <a href="index.html" class="text-white">IC</a>
        </div>
        <ul class="sidebar-menu bg-dark">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Tableau de bord</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('home') }}">Général</a></li>
                    <li><a class="nav-link" href="index.html">Comptabilité</a></li>
                </ul>
            </li>
            @hasrole('admin|reception')
            <li class="menu-header">Reception</li>
            <li><a class="nav-link" href="{{ route('commandes.index') }}"><i class="fas fa-box"></i> <span>Commandes</span></a></li>
            <li><a class="nav-link" href="{{ route('clients.index') }}"><i class="fas fa-users"></i> <span>Clients</span></a></li>
            @endhasrole
            @hasrole('admin|designer')
            <li class="menu-header">Infographiste</li>
            <li>
                <a class="nav-link" href="{{ route('commandes.design') }}"><i class="fas fa-box"></i> <span>Fichiers</span>
                    <span class="badge badge-pill">{{$commandes_design}}</span>
                </a>
            </li>
            @endhasrole
            @hasrole('admin|finition')
            <li class="menu-header">Finition</li>
            <li><a class="nav-link" href="{{ route('commandes.finition') }}"><i class="fas fa-box"></i> <span>Fichiers</span>
                    <span class="badge badge-pill">{{$commandes_finition}}</span>
                </a>
            </li>
            @endhasrole
            @hasrole('admin')
            <li class="menu-header">Paramètres</li>
            <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> <span>Utilisateurs</span></a></li>
            @endhasrole
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">

        </div>        </aside>
</div>
