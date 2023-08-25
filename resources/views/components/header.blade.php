<header class="c-header c-header-light c-header-fixed bg-dark text-white c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show">
        <i class="fas fa-bars c-icon text-white c-icon-lg"></i>
    </button>
    <div>
        <a class="c-header-brand d-lg-none text-center justify-content-center" href="#">
            <img src="{{ asset('assets/blk/img/Web/tecnologia_verde_3d_96.png') }}" width="32px" height="32px">
            <b
                style="padding-top: 5px!important; padding-left: 5px !important; font-size: 25px; color: white !important;">
                GA • RNEC
            </b>
        </a>
    </div>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-bars text-white c-icon c-icon-lg"></i>
    </button>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <div class="c-avatar">
                    @if (auth()->check())
                        @if (auth()->user()->profile_photo_path != null)
                            <img class="c-avatar-img"
                                src="{{ asset('storage/users/' . auth()->user()->profile_photo_path) }}"
                                alt="user@email.com" />
                        @else
                            <img class="c-avatar-img" src="{{ asset(auth()->user()->municipality->profile_photo_path) }}"
                                alt="user@email.com" />
                        @endif
                    @else
                        <img class="c-avatar-img" src="{{ asset(auth()->user()->municipality->profile_photo_path) }}"
                            alt="user@email.com" />
                    @endif
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>Mi cuenta</strong>
                </div>
                <span class="dropdown-item">
                    <i class="fas fa-mail-bulk c-icon mr-2"></i>
                    @if (auth()->check())
                        {{ auth()->user()->email }}
                    @else
                        NO USER
                    @endif
                </span>
                @if (auth()->check())
                    <span class="dropdown-item" data-toggle="modal" data-target="#UpdatePasswordUserModal">
                        <i class="fas fa-user-lock mr-2"></i>
                        Cambiar contraseña
                    </span>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt c-icon mr-2"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>
    </ul>
</header>
