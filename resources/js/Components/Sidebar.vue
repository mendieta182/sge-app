<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <inertia-link :href="route('admin.dashboard.index')" class="brand-link">
            <img :src="'/storage/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SGE</span>
        </inertia-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="'/storage/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $page.props.user.name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <inertia-link :href="route('admin.dashboard.index')" class="nav-link" :class="route().current('admin.dashboard.*') ? 'active':'' ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </inertia-link>
                    </li>
                    <li class="nav-item" :class="route().current('admin.admins.*|admin.roles.*|admin.users.*|admin.permissions.*') ? 'menu-is-opening menu-open':''">
                        <a href="#" class="nav-link" :class="route().current('admin.admins.*|admin.roles.*|admin.users.*|admin.permissions.*') ? 'active':''">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Administration
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <inertia-link :href="route('admin.admins.index')" class="nav-link" :class="route().current('admin.admins.*') ? 'active':''">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admins</p>
                                </inertia-link>
                            </li>
                            <li class="nav-item">
                                <inertia-link :href="route('admin.users.index')" class="nav-link" :class="route().current('admin.users.*') ? 'active':''">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </inertia-link>
                            </li>
                            <li class="nav-item">
                                <inertia-link :href="route('admin.roles.index')" class="nav-link" :class="route().current('admin.roles.*') ? 'active':''">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </inertia-link>
                            </li>
                            <li class="nav-item">
                                <inertia-link :href="route('admin.permissions.index')" class="nav-link" :class="route().current('admin.permissions.*') ? 'active':''">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </inertia-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">MISCELANEA</li>
                    <li class="nav-item">
                        <inertia-link :href="route('dashboard')" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Site</p>
                        </inertia-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>

    export default{

    }
</script>
