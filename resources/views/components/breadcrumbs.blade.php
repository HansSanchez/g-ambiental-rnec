<div {{$attributes}}>
    <!-- Breadcrumb-->
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item {{ $active1 ? 'active' : '' }}">{{ $level1 }}</li>
        @if($level2 != NULL)
            <li class="breadcrumb-item {{ $active2 ? 'active' : '' }}">{{ $level2 }}</li>
        @endif
        @if($level3 != NULL)
            <li class="breadcrumb-item {{ $active3 ? 'active' : '' }}">{{ $level3 }}</li>
        @endif
        @if($level4 != NULL)
            <li class="breadcrumb-item {{ $active4 ? 'active' : '' }}">{{ $level4 }}</li>
        @endif
    </ol>
    <!-- End breadcrumb-->
</div>
