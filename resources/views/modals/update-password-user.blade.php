<div class="modal fade" id="UpdatePasswordUserModal" role="dialog" aria-labelledby="UpdatePasswordUserModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-ambiental">
                <h5 class="modal-title text-uppercase text-white" id="exampleModalLongTitle">
                    @if (auth()->user()->role->name == 'admin')
                        <b>Actualización de contraseña</b>
                    @else
                        <b>Actualización de contraseña del usuario {{ auth()->user()->first_name }}</b>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <v-icon style="color: #fff;">mdi-close</v-icon>
                    </span>
                </button>
            </div>
            <form action="{{ route('updatePassword') }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background: #e7e7e7 !important;">
                    <div class="row">
                        @if (auth()->user()->role->name == 'admin')
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group text-uppercase mb-0">
                                    <b>Usuarios <span class="text-danger">*</span></b>
                                    <select name="user_id" id="users-select-password"
                                        class="form-control users-select-password" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" class="user_id" name="user_id" value="{{ auth()->user()->id }}">
                        @endif
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-uppercase">
                                <b>Nueva contraseña <span class="text-danger">*</span></b>
                                <input type="password" style="border: 1px solid #000" class="form-control"
                                    name="password" id="password" placeholder="********" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-uppercase">
                                <b>Confirmación contraseña <span class="text-danger">*</span></b>
                                <input type="password" style="border: 1px solid #000" class="form-control"
                                    name="password_confirmation" id="password_confirmation" placeholder="********"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                        <b>CANCELAR</b>
                    </v-btn>
                    <v-btn type="submit" color="#2eb85c" small class="btn btn-success text-uppercase text-white">
                        <b>ACTUALIZAR</b>
                    </v-btn>
                </div>
            </form>
        </div>
    </div>
</div>
