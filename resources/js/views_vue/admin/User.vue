<template>
    <div v-if="permissions.browse_users === 'browse_users' ||
        permissions.read_users === 'read_users' ||
        permissions.edit_users === 'edit_users' ||
        permissions.add_users === 'add_users' ||
        permissions.delete_users === 'delete_users'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <a href="/v/admin/users">
                                    <b>Usuarios</b>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body" style="background: #d7d7d7 !important;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0 mb-sm-5"
                            v-if="permissions.add_users === 'add_users'">
                            <button @click="update = false; resetFormUser();" type="button" data-toggle="modal"
                                data-target="#UpdateOrCreateUsersModal" data-backdrop="static" data-dismiss="modal"
                                class="btn btn-success text-uppercase tip-customer btn-new w-100" title="Nueva usuario">
                                <v-icon color="#FFFFFF">mdi-plus-circle</v-icon>
                            </button>
                            <!-- End button trigger modal -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0">
                            <!-- <div class="form-group mb-0"
                                v-if="permissions.filter_delegations === 'filter_delegations'"> -->
                            <div class="form-group mb-0">
                                <v-select :options="delegations" @search="setDelegations" @input="queryFilter()"
                                    v-model="delegations_model" placeholder="DELEGACIONES...">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-1">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" v-model="dateFilter" @change="queryFilter()">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 w-100 pt-0 mb-1">
                            <div class="input-group">
                                <input type="search" style="border-right: none !important;" v-model="searchInput"
                                    id="search" class="form-control" @change="changeType" placeholder="Buscar...">
                                <span class="input-group-text border-search bg-info" title="Buscar" @click="$emit('Enter')">
                                    <i class="fa-solid fa-search text-white"></i>
                                </span>
                                <span v-if="permissions.import_massive_users === 'import_massive_users'"
                                    class="input-group-text border-search bg-warning" title="Cargue masivo"
                                    data-toggle="modal" data-backdrop="static" data-target="#ImportUsersModal">
                                    <i class="fa-solid fa-upload text-white"></i>
                                </span>
                                <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                                    <i class="fa-solid fa-rotate text-white"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Modal create or update-->
                    <div v-show="permissions.add_users === 'add_users' ||
                        permissions.edit_users === 'edit_users'" class="modal fade-scale" id="UpdateOrCreateUsersModal"
                        tabindex="-1" role="dialog" aria-labelledby="UpdateOrCreateUsersModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e;">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>{{ update ? 'Actualizar' : 'Nuevo' }} Usuario</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff;">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body bv-modal">
                                    <div class="row justify-content-center text-center">
                                        <div v-if="update" class="col-lg-3 col-md-4 col-sm-12 col-xs-12"
                                            style="display: grid; justify-content: center;">
                                            <h5><b>Foto</b></h5>
                                            <img v-if="FormPhoto.profile_photo_path"
                                                :src="'/storage/users/' + FormPhoto.profile_photo_path" width="150px"
                                                height="100%" alt="">
                                            <img v-if="!FormPhoto.profile_photo_path"
                                                src="/assets/img/avatars/pngwing.com.png" width="150px" height="100%"
                                                alt="">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="name" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Cédula <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormUser.personal_id" type="number"
                                                            name="personal_id" id="personal_id" class="form-control"
                                                            placeholder="Número de cédula del funcionari@" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="name" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Primer nombre <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormUser.first_name" type="text" name="first_name"
                                                            id="first_name" class="form-control"
                                                            placeholder="Primer nombre del funcionari@" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <h5><b>Segundo nombre</b></h5>
                                                <input v-model="FormUser.second_name" type="text" name="second_name"
                                                    id="second_name" class="form-control"
                                                    placeholder="Segundo nombre del funcionari@" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="name" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Primer apellido <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormUser.first_last_name" type="text"
                                                            name="first_last_name" id="first_last_name" class="form-control"
                                                            placeholder="Primer apellido del funcionari@" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <h5><b>Segundo apellido</b></h5>
                                                <input v-model="FormUser.second_last_name" type="text"
                                                    name="second_last_name" id="second_last_name" class="form-control"
                                                    placeholder="Segundo apellido del funcionari@" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="phone_number" rules="required|email">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Correo electrónico <span class="text-danger">*</span></b>
                                                        </h5>
                                                        <input v-model="FormUser.email" type="email" name="email" id="email"
                                                            class="form-control" placeholder="Correo del/a colaborador/a">
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="phone_number" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Celular <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormUser.phone_number" type="number"
                                                            name="phone_number" id="phone_number" class="form-control"
                                                            placeholder="Número de celular del colaborador" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="phone_number" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Delegaciones <span class="text-danger">*</span></b></h5>
                                                        <v-select :options="delegations" @search="setDelegations"
                                                            v-model="FormUser.delegation" placeholder="Buscar...">
                                                        </v-select>
                                                    </div>
                                                    <p class="text-danger">
                                                        <b>{{ errors[0] }}</b>
                                                    </p>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div v-if="role === 'admin'" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="position" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5>
                                                            <b>Roles <span class="text-danger">*</span></b>
                                                        </h5>
                                                        <v-select :options="roles" @search="setRoles"
                                                            v-model="FormUser.role" placeholder="Buscar...">
                                                        </v-select>
                                                    </div>
                                                    <p class="text-danger">
                                                        <b>{{ errors[0] }}</b>
                                                    </p>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="position" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>Cargo <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormUser.position" type="text" name="position"
                                                            id="position" class="form-control"
                                                            placeholder="Cargo a desempeñar" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="position" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group">
                                                        <h5><b>ESTADO <span class="text-danger">*</span></b></h5>
                                                        <select class="form-control" v-model="FormUser.active" id="active">
                                                            <option value="ACTIVO">ACTIVO</option>
                                                            <option value="INACTIVO">INACTIVO</option>
                                                        </select>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-3">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                    <v-btn type="button" v-if="permissions.add_users === 'add_users' ||
                                        permissions.edit_users === 'edit_users'" @click="createOrUpdate();"
                                        color="#2eb85c" small class="btn btn-success text-uppercase text-white"
                                        data-dismiss="modal">
                                        <b>{{ update ? 'Actualizar' : 'Guardar' }}</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal -->

                    <!-- MASSIVE -->
                    <div v-show="permissions.import_massive_users === 'import_massive_users'" class="modal fade"
                        id="ImportUsersModal" tabindex="-1" role="dialog" aria-labelledby="ImportUsersModalTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e;">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>Cargue masivo de usuarios</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff;">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background: #e7e7e7 !important;">
                                    <div class="row justify-content-center text-center">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <blockquote class="blockquote">
                                                <div class="row">
                                                    <div class="col-md-10 ml-auto mr-auto">
                                                        <blockquote class="blockquote">
                                                            Por favor seleccione el archivo a subir, tenga en cuenta
                                                            que:
                                                            <br>
                                                            <strong>El archivo debe ser .xlsx</strong>
                                                            <br>
                                                            <br>
                                                            <a type="button" class="btn btn-sm w-100 text-white btn-info btn-blue"
                                                                download
                                                                href="/documents/PLANTILLA-PARA-CARGA-MASIVA-DE-USUARIOS.xlsx">
                                                                <b>P</b><b class="text-uppercase">lantilla de cargue</b>
                                                            </a>
                                                            <br>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center mt-0">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group mb-0">
                                                            <input type="file" class="form-control"
                                                                @change="selectedFileImportUsers"
                                                                style="height: 41px !important;"
                                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                    <v-btn type="button" @click="uploadImportUsers" color="#2eb85c" small
                                        class="btn btn-success text-white" data-dismiss="modal">
                                        <b>CARGAR USUARIOS</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END -->

                </div>
            </div>
            <div class="modal fade" id="UpdateProfileImage" tabindex="-1" role="dialog"
                aria-labelledby="UpdateProfileImageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #88b76e;">
                            <h5 class="modal-title text-uppercase text-white">
                                <b>ACTUALIZACIÓN DE FOTO DEL USUARIO {{ selectedUser.first_name }}</b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <v-icon style="color: #fff;">mdi-close</v-icon>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body" style="background: #e7e7e7 !important;">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div id="preview">
                                        <img v-if="url" :src="url" />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>
                                        <span class="text-danger">
                                            <b>NOTA:</b>
                                        </span>
                                        <small>Recuerde que la foto debe <b>.jpg</b> o <b>.png</b></small>
                                    </label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" @change="selectedFile"
                                            style="height: 41px !important;" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                                <b>CANCELAR</b>
                            </v-btn>
                            <v-btn @click="photoUpload" small color="#2eb85c" data-dismiss="modal" type="button"
                                class="btn btn-sm text-white btn-success">
                                <b>ACTUALIZAR</b>
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="permissions.browse_users === 'browse_users' ||
                permissions.read_users === 'read_users' ||
                permissions.edit_users === 'edit_users' ||
                permissions.add_users === 'add_users' ||
                permissions.delete_users === 'delete_users'" class="table-responsive max-h-650">
                <table id="sub_area-table" class="table table-sm table-bordered table-striped table-condensed bg-white">
                    <thead class="bg-orange headerStatic">
                        <tr class="text-center">
                            <th class="tt-espumados">FOTO</th>
                            <th class="tt-espumados">ACTIVO</th>
                            <th class="tt-espumados">NOMBRE</th>
                            <th class="tt-espumados">CORREO ELECTRÓNICO</th>
                            <th class="tt-espumados" width="200px">DELEGACIÓN</th>
                            <th class="tt-espumados" width="200px">CREAD@</th>
                            <th v-if="permissions.browse_users === 'browse_users' ||
                                permissions.read_users === 'read_users' ||
                                permissions.edit_users === 'edit_users' ||
                                permissions.add_users === 'add_users' ||
                                permissions.delete_users === 'delete_users'" class="tt-espumados">
                                OPCIONES
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list" :key="index">
                            <td v-if="item.profile_photo_path" class="text-center defaultCenter" width="52px">
                                <img :src="'/storage/users/' + item.profile_photo_path" class="defaultCenter"
                                    @click="selectedUser = item; url = null" data-toggle="modal"
                                    data-target="#UpdateProfileImage" style="border-radius: 20px !important; cursor: pointer;
                                    max-width: 50px !important;
                                    width: 50px !important;
                                    max-height: 50px !important;
                                    height: 50px !important;">
                            </td>
                            <td v-if="!item.profile_photo_path" class="text-center defaultCenter" width="52px">
                                <img src="/assets/img/avatars/pngwing.com.png" class="defaultCenter"
                                    @click="selectedUser = item; url = null" data-toggle="modal"
                                    data-target="#UpdateProfileImage" style="border-radius: 20px !important; cursor: pointer;
                                    max-width: 50px !important;
                                    width: 50px !important;
                                    max-height: 50px !important;
                                    height: 50px !important;">
                            </td>
                            <td class="text-center text-uppercase text-uppercase" v-html="item.ActiveLabel"></td>
                            <td class="text- text-center">
                                {{ item.FullName }}
                            </td>
                            <td class="text-lowercase text-center">
                                {{ item.email }}
                            </td>
                            <td class="text-uppercase text-center">
                                {{
                                    item.delegation ?
                                    item.delegation.name :
                                    'SIN DELEGACIÓN'
                                }}
                            </td>
                            <td class="text-lowercase text-center">
                                {{ item.CreatedLabel }}
                            </td>
                            <td v-if="permissions.browse_users === 'browse_users' ||
                                permissions.read_users === 'read_users' ||
                                permissions.edit_users === 'edit_users' ||
                                permissions.add_users === 'add_users' ||
                                permissions.delete_users === 'delete_users'"
                                class="text-center justify-content-center">
                                <div class="btn-group" role="group">
                                    <span v-if="permissions.edit_users === 'edit_users'"
                                        @click="update = true; writeData(item);" data-toggle="modal" title="Editar"
                                        data-target="#UpdateOrCreateUsersModal" data-backdrop="static"
                                        class="text-warning cursor-pointer">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler" spinner="waveDots"
                    ref="infiniteHandler">
                    <div slot="no-more">
                        No hay más usuarios
                    </div>
                    <div slot="no-results">
                        No hay usuarios
                    </div>
                </infinite-loading>
            </div>
        </div>
    </div>
    <div v-else>
        <forbidden-component></forbidden-component>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading"; // Componente para hacer un scroll infitito el cual solo me hace una consulta inicial de 10 registros esto se complementa con el controlador y un simplePaginate

export default {
    components: {
        InfiniteLoading,
    },
    name: "User",
    data() {
        return {
            FormUser: {
                personal_id: null,
                first_name: null,
                second_name: null,
                first_last_name: null,
                second_last_name: null,
                email: null,
                position: null,
                phone_number: '',
                active: 'ACTIVO',
                delegation: null,
                role: { code: 2, label: 'Normal User' },
            },
            FormPhoto: {
                profile_photo_path: null,
            },
            FormImportUsers: {
                file: null,
            },
            id: '',
            role: '',
            update: true,
            page: 1,
            list: [],
            permissions: [],
            rhOptions: [],
            url: null,
            infiniteId: +new Date(),
            delegations: [],
            roles: [],
            searchInput: '',
            setTimeoutSearch: '',
            selectedUser: '',
            errors: null,
            values: [],
            delegations_model: [],
            dateFilter: null,
        }
    },
    props: {
        usersAssignData: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/users/getUsers";
            axios.get(api, { params: { page: this.page, search: this.searchInput } }).then(({ data }) => {
                if (data.users.data.length > 0) {
                    this.role = data.role;
                    this.page += 1;
                    this.list.push(...data.users.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.response(error) : ""));
        },
        changeType() {
            this.page = 1;
            this.list = [];
            this.infiniteId += 1;
        },
        clean() {
            this.searchInput = null;
            this.dateFilter = null;
            this.delegations_model = null;
            this.changeType();
        },
        queryFilter($state) {
            let api = "/g-environmental-rnec/users/getUsers";
            axios.get(api, {
                params: {
                    search: this.searchInput,
                    delegations_model: this.delegations_model,
                    dateFilter: this.dateFilter,
                }
            }).then(({ data }) => {
                // VACIO EL ARRAY PARA MOSTRAR LOS RESULTADOS DEL FILTRO
                for (let i = this.list.length; i > 0; i--) this.list.pop();

                // PINTO NUEVAMENTE LOS DATOS SEGÚN LOS FILTROS
                if (data.users.data.length > 0) {
                    this.list.push(...data.users.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.response(error) : ""));
        },
        createOrUpdate() {
            let url = this.update ? '/g-environmental-rnec/users/' + this.id + '/update' : '/g-environmental-rnec/users/store';
            axios.post(url, this.FormUser)
                .then(response => {
                    this.alerts(response.data); // Es un método personalizado para mostrar una alerta con un SweetAlert
                    if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.user.id)), 1);
                    else this.resetFormUser();
                    this.list.unshift(response.data.user); // unshift sirve para agregar el elemento al array al inicio, push lo agrega al final
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        // CAPTURA DE ERRORES DESDE EL BACKEND
                        let msg = ''

                        // RECORRE TODOS LOS ERRORES Y LOS ADJUNTA EN UNA VARIABLE
                        Object.values(error.response.data.errors)
                            .map((errors, index) =>
                                msg += `<li style="margin-bottom: 10px !important;"><b>${index + 1}.</b> ${errors[0]}</li>`)

                        // ALERTA QUE MUESTRA AL USUARIO FINAL LOS ERRORES
                        this.$swal({
                            icon: 'error', // ICONO LLEGA DEL BACK
                            title: '¡Hola! te invitamos a que revises tús campos',
                            html: `<ul class="text-danger text-left">${msg}</ul>`, // VALIDACIONES DE REGLAS DEL BACK
                            showConfirmButton: false, // EVITA QUE EL USUARIO CIERRE SIN LEER LOS ERRORES
                            timer: 10000, // 10 SEG PARA QUE EL USUARIO LEA
                            timerProgressBar: true,
                        })
                    } else this.response(error);
                });
        },
        selectedFileImportUsers(event) {
            this.FormImportUsers.file = event.target.files[0];
        },
        uploadImportUsers() {
            let FormImportUsers = new FormData();
            for (let key in this.FormImportUsers) FormImportUsers.append(key, this.FormImportUsers[key])
            let api = "/g-environmental-rnec/users/importUsers";
            axios.post(api, FormImportUsers).then(response => {
                console.log(response);
                window.toastr.success(response.data.msg, { timeOut: 5000 });
                this.changeType();
            }).catch(error => error.response ? this.response(error) : '');
        },
        resetFormUser() {
            this.$data["FormUser"] = this.$options.data.call(this)["FormUser"];
            this.url = null;
        },
        selectedFile(event) {
            this.url = URL.createObjectURL(event.target.files[0]);
            this.FormPhoto.profile_photo_path = event.target.files[0];
        },
        photoUpload() {
            let FormPhoto = new FormData();
            for (let key in this.FormPhoto) FormPhoto.append(key, this.FormPhoto[key])
            let api = "/g-environmental-rnec/users/" + this.selectedUser.id + '/photoUpload';
            axios.post(api, FormPhoto).then(response => {
                window.toastr.success(response.data.msg, { timeOut: 5000 });
                if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.user.id)), 1);
                this.list.unshift(response.data.user); // unshift sirve para agregar el elemento al array al inicio, push lo agrega al final
            }).catch(error => error.response ? this.response(error) : '');
        },
        writeData(data = {}) {
            if (this.update) {
                this.id = data.id;
                this.FormUser.personal_id = data.personal_id;
                this.FormUser.first_name = data.first_name.toUpperCase();
                this.FormUser.second_name = data.second_name.toUpperCase();
                this.FormUser.first_last_name = data.first_last_name.toUpperCase();
                this.FormUser.second_last_name = data.second_last_name.toUpperCase();
                this.FormUser.active = data.active;
                this.FormUser.email = data.email;
                this.FormUser.phone_number = data.phone_number;
                this.FormUser.position = data.position;
                this.FormPhoto.profile_photo_path = data.profile_photo_path;
                if (data.delegation) this.FormUser.delegation = { code: data.delegation.id, label: data.delegation.name };
                if (data.role) this.FormUser.role = { code: data.role.id, label: data.role.name };
            }
        },
        setPermissions() {
            axios.post("/g-environmental-rnec/home/permissions")
                .then(response => this.permissions = response.data)
                .catch(errors => console.log(errors));
        },
        setDelegations(search) { // Función para traer las sociedades en un v-select
            axios.get('/g-environmental-rnec/delegations/getDelegations', { params: { search: search } })
                .then(res => this.delegations = res.data.data)
                .catch(error => (error.response) ? this.response(error) : '');
        },
        setRoles(search) { // Función para traer los roles en un v-select
            axios.get('/g-environmental-rnec/users/getRoles', { params: { search: search } })
                .then(res => this.roles = res.data.data)
                .catch(error => (error.response) ? this.response(error) : '');
        },
        response(error) {
            if (error.response.status === 500) {
                this.$swal({
                    icon: error.response.data.icon ? error.response.data.icon : 'warning',
                    title: 'Oops!',
                    html: '<p class="text-justify"><b class="text-danger">Error:</b> ' + error.response.data.message + '</p>',
                    showConfirmButton: false,
                });
            }
        },
        alerts(response) {
            this.$swal({
                icon: response.icon,
                title: response.msg,
                showConfirmButton: false,
                timer: 1000
            });
        },

    },
    created() {
        this.setDelegations();
        this.setRoles();
        this.setPermissions();
    }
}
</script>

<style scoped>
.border-search {
    cursor: pointer !important;
    border-radius: 0;
    border-top: solid 1px #000000 !important;
    border-bottom: solid 1px #000000 !important;
    border-left: 0 !important;
    border-right: 0 !important;
}

.border-custom {
    cursor: pointer !important;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top: solid 1px #000000 !important;
    border-bottom: solid 1px #000000 !important;
    border-right: solid 1px #000000 !important;
    border-left: 0 !important;
}

input,
select,
v-select,
textarea,
.vdp-datepicker {
    border: 1px solid #000000 !important;
}

.vs--searchable,
.vs__dropdown-toggle {
    box-sizing: border-box;
    background: #FFFFFF !important;
    color: #000 !important;
    border-radius: 4px !important;
    border: 1px solid !important;
}

#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 500px;
}
</style>
