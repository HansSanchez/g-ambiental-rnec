@if (auth()->check())
    @php
        // PERMISOS
        $permissions = [];
        $query_permissions = auth()
            ->user()
            ->role->permissions->pluck('key');
        foreach ($query_permissions as $query_permission) {
            $permissions[$query_permission] = $query_permission;
        }
    @endphp
@else
    @php
        // Redireccionar al login
        return redirect()->route('login');
    @endphp
@endif

{{-- @dd($permissions) --}}
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <a href="/">
            <img class="c-sidebar-brand-full" src="{{ asset('assets/blk/img/Web/tecnologia_verde_3d_96.png#signet') }}"
                width="32px" height="32px">
        </a>
        <a href="/">
            <b class="c-sidebar-brand-full"
                style="padding-top: 5px!important; padding-left: 5px !important; font-size: 25px; color: white !important;">
                GA • RNEC
            </b>
        </a>
        <a href="/">
            <img class="c-sidebar-brand-minimized"
                src="{{ asset('assets/blk/img/Web/tecnologia_verde_3d_96.png#signet') }}" width="32px" height="32px">
        </a>
    </div>
    <ul class="c-sidebar-nav">

        <li class="c-sidebar-nav-title">Gestiones del sistema</li>

        <li class="c-sidebar-nav-item">
            <router-link :to="{ name: 'home' }" class="c-sidebar-nav-link" title="Página de inicio">
                <i class="fas fa-home c-sidebar-nav-icon"></i>
                Inicio
            </router-link>
        </li>

        @if (array_key_exists('browse_admin', $permissions))
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/admin') }}" target="_blank" title="Administradores" class="c-sidebar-nav-link">
                    <i class="fas fa-users-cog c-sidebar-nav-icon"></i>
                    Administradores
                </a>
            </li>
        @endif

        @if (array_key_exists('logs', $permissions))
            <li class="c-sidebar-nav-item">
                <a href="/logs/" title="Logs" class="c-sidebar-nav-link" target="_blank">
                    <i class="fas fa-bug c-sidebar-nav-icon"></i>
                    Logs
                </a>
            </li>
        @endif

        @if (array_key_exists('browse_audits', $permissions))
            <li class="c-sidebar-nav-item">
                <router-link :to="{ name: 'audits' }" class="c-sidebar-nav-link" title="Auditorias">
                    <i class="fas fa-eye c-sidebar-nav-icon"></i>
                    Auditorias
                </router-link>
            </li>
        @endif

        @if (array_key_exists('browse_users', $permissions))
            <li class="c-sidebar-nav-item">
                <router-link :to="{ name: 'users' }" class="c-sidebar-nav-link" title="Usuarios">
                    <i class="fas fa-people-group c-sidebar-nav-icon"></i>
                    Usuarios
                </router-link>
            </li>
        @endif

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>

{{-- Cambio de contraseña --}}
@include('modals.update-password-user')
