<!DOCTYPE html>
<html lang="en">
<x-head></x-head>

<body class="c-app">
    <div id="app" style="width: 100% !important;">
        <x-sidebar></x-sidebar>
        <div class="c-wrapper c-fixed-components">
            <x-header></x-header>
            <div class="c-body">
                <div class="c-main">
                    <div class="container-fluid">
                        <div class="fade-in">
                            <div id="vr">
                                @include('flash::message')
                                <content-component></content-component>
                            </div>
                            <div id="sl">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{ $slot ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <!-- <script src="https://kit.fontawesome.com/84d38f548e.js" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/c6ef26fdf4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/i18n/es.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $('#users-select-password').select2({
            width: '100%',
            ajax: {
                url: '{{ route('usersSelectPassword') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1,
                        user_id: params.user_id || $('.user_id').val(),
                    }
                },
                cache: true
            },
            delay: 250,
            lang: "{{ config('app.locale') }}",
            placeholder: "Buscar usuario...",
        });
    </script>
</body>

</html>
