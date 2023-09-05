<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_headquarters === 'browse_headquarters' ||
        permissions.read_headquarters === 'read_headquarters' ||
        permissions.edit_headquarters === 'edit_headquarters' ||
        permissions.add_headquarters === 'add_headquarters' ||
        permissions.delete_headquarters === 'delete_headquarters'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <a href="/v/admin/headquarters">
                                    <b>Sedes</b>
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
                            v-if="permissions.add_headquarters === 'add_headquarters'">
                            <button @click="update = false; resetFormHeadquarters(); filterDelagations = false;
                            municipalities = []; setMunicipalitiesFilter(); clean();" type="button" data-toggle="modal"
                                data-target="#UpdateOrCreateHeadquartersModal" data-backdrop="static" data-dismiss="modal"
                                class="btn btn-success text-uppercase tip-customer btn-new w-100" title="Nueva sede">
                                <v-icon color="#FFFFFF">mdi-plus-circle</v-icon>
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_delegations_headquarters === 'filter_delegations_headquarters'"
                                class="form-group mb-0">
                                <v-select :options="delegations" @search="setDelegations" @input="queryFilter(); filterDelagations = true;
                                municipalities_model = null; municipalities = []; setMunicipalitiesFilter();"
                                    v-model="delegations_model" placeholder="DELEGACIONES...">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_delegations_headquarters === 'filter_delegations_headquarters'"
                                class="form-group mb-0">
                                <v-select :options="municipalities" v-model="municipalities_model"
                                    @search="setMunicipalitiesFilter" @input="queryFilter();" placeholder="MUNICIPIOS..."
                                    :disabled="delegations_model === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 w-100 pt-0 mb-1">
                            <div class="input-group">
                                <input type="search" style="border-right: none !important;" v-model="searchInput"
                                    id="search" class="form-control" @change="changeType" placeholder="Buscar...">
                                <span class="input-group-text border-search bg-info" title="Buscar" @click="$emit('Enter')">
                                    <i class="fa-solid fa-search text-white"></i>
                                </span>
                                <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                                    <i class="fa-solid fa-rotate text-white"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Modal create or update-->
                    <div v-show="permissions.add_headquarters === 'add_headquarters' ||
                        permissions.edit_headquarters === 'edit_headquarters'" class="modal fade-scale"
                        id="UpdateOrCreateHeadquartersModal" tabindex="-1" role="dialog"
                        aria-labelledby="UpdateOrCreateHeadquartersModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e;">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>{{ update ? 'Actualizar' : 'Nuevo' }} Sede</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff;">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body bv-modal">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                            <div class="alert alert-info mb-0" role="alert">
                                                <h5>
                                                    <b class="full-center">
                                                        <i class="fa-solid fa-circle-info fa-2x"></i>
                                                        <strong class="pl-2">RECOMENDACIONES:</strong>
                                                    </b>
                                                </h5>
                                                <ul class="list-general text-justify">
                                                    <li class="list-general pb-3">
                                                        <strong>
                                                            Para una óptima gestión y creación de los datos, le invitamos a
                                                            verificar antes de crear una sede que no esté previamente
                                                            registrada con un nombre diferente, se dejó este proceso abierto
                                                            debido a la alta demanda de nuevas sedes.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general pb-3">
                                                        <strong>
                                                            Por razones de seguridad, la creación de sedes está limitada
                                                            exclusivamente a la delegación a la cual usted pertenezca.
                                                            Esto se hace con el objetivo de minimizar al máximo la
                                                            duplicidad de información.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general">
                                                        <strong>
                                                            Si tiene alguna duda con respecto a la creación de sedes lo
                                                            invitamos a contactar con: "SEDE CENTRAL - BOGOTÁ".
                                                        </strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 pb-0">
                                            <ValidationProvider name="name" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-1">
                                                        <h5><b>SEDE <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormHeadquarters.name" type="text" name="name"
                                                            id="name" class="form-control" placeholder="Nombre de la sede"
                                                            required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pb-0">
                                            <ValidationProvider name="in_charge" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-1">
                                                        <h5><b>LÍDER <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormHeadquarters.in_charge" type="text"
                                                            name="in_charge" id="in_charge" class="form-control"
                                                            placeholder="Persona a cargo en la sede" required>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pb-0">
                                            <ValidationProvider name="in_charge" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-1">
                                                        <h5><b>TIPO <span class="text-danger">*</span></b></h5>
                                                        <select class="form-control" name="year" id="year"
                                                            v-model="FormHeadquarters.type">
                                                            <option value="" selected disabled>TIPOS...</option>
                                                            <option v-for="(item, index) in types" :key="index">
                                                                {{ item }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="in_charge" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-1">
                                                        <h5><b>DELEGACIÓN <span class="text-danger">*</span></b></h5>
                                                        <v-select :options="delegations"
                                                            v-model="FormHeadquarters.delegation"
                                                            @input="filterDelagations = false; municipalities = []; setMunicipalitiesFilter();"
                                                            :disabled="validateDelegation" placeholder="DELEGACIONES...">
                                                        </v-select>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="in_charge" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-1">
                                                        <h5><b>MUNICIPIOS <span class="text-danger">*</span></b></h5>
                                                        <v-select :options="municipalities"
                                                            v-model="FormHeadquarters.municipality"
                                                            placeholder="MUNICIPIOS..."
                                                            :disabled="FormHeadquarters.delegation === null ? true : false">
                                                        </v-select>
                                                    </div>
                                                    <small>
                                                        <p class="text-danger mb-0">
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
                                    <v-btn type="button" v-if="permissions.add_headquarters === 'add_headquarters' ||
                                        permissions.edit_headquarters === 'edit_headquarters'"
                                        @click="createOrUpdate(); alertLoading(15000, 'Cargando y creando bloques de información para la sede.', 'info');"
                                        color="#2eb85c" small class="btn btn-success text-uppercase text-white"
                                        data-dismiss="modal" :disabled="validateFormHeadquarters()">
                                        <b>{{ update ? 'Actualizar' : 'Guardar' }}</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal -->

                </div>
            </div>

            <div v-if="permissions.browse_headquarters === 'browse_headquarters' ||
                permissions.read_headquarters === 'read_headquarters' ||
                permissions.edit_headquarters === 'edit_headquarters' ||
                permissions.add_headquarters === 'add_headquarters' ||
                permissions.delete_headquarters === 'delete_headquarters'" class="table-responsive max-h-650">
                <table id="sub_area-table" class="table table-sm table-hover table-bordered table-condensed bg-white">
                    <thead class="headerStatic">
                        <tr class="text-center">
                            <th>ID</th>
                            <th class="tt-espumados">NOMBRE</th>
                            <th class="tt-espumados">LÍDER</th>
                            <th class="tt-espumados">TIPO</th>
                            <th class="tt-espumados">DELEGACIÓN</th>
                            <th class="tt-espumados">MUNICIPIO</th>
                            <th class="tt-espumados">CREADOR(A)</th>
                            <th class="tt-espumados">CREADO</th>
                            <th v-if="permissions.browse_headquarters === 'browse_headquarters' ||
                                permissions.read_headquarters === 'read_headquarters' ||
                                permissions.edit_headquarters === 'edit_headquarters' ||
                                permissions.add_headquarters === 'add_headquarters' ||
                                permissions.delete_headquarters === 'delete_headquarters'" class="tt-espumados">
                                OPCIONES
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list" :key="index">
                            <td class="text-uppercase text-center bg-register text-white">
                                <b>{{ item.id }}</b>
                            </td>
                            <td class="text-uppercase text-center">
                                <b>{{ item.name }}</b>
                            </td>
                            <td class="text-uppercase text-center">
                                {{ item.in_charge }}
                            </td>
                            <td class="text-uppercase text-center">
                                {{ item.type }}
                            </td>
                            <td class="text-uppercase text-center">
                                {{
                                    item.delegation ?
                                    item.delegation.name :
                                    'SIN DELEGACIÓN'
                                }}
                            </td>
                            <td class="text-uppercase text-center">
                                {{
                                    item.municipality ?
                                    item.municipality.city_name :
                                    'SIN MUNICIPIO'
                                }}
                            </td>
                            <td class="text-uppercase text-center">
                                {{
                                    item.user ?
                                    item.user.FullName :
                                    'SIN CREADOR(A)'
                                }}
                            </td>
                            <td class="text-lowercase text-center">
                                {{ item.CreatedLabel }}
                            </td>
                            <td v-if="permissions.browse_headquarters === 'browse_headquarters' ||
                                permissions.read_headquarters === 'read_headquarters' ||
                                permissions.edit_headquarters === 'edit_headquarters' ||
                                permissions.add_headquarters === 'add_headquarters' ||
                                permissions.delete_headquarters === 'delete_headquarters'"
                                class="text-center justify-content-center">
                                <div class="btn-group" role="group">
                                    <span v-if="permissions.edit_headquarters === 'edit_headquarters'"
                                        @click="update = true; writeData(item);" data-toggle="modal" title="Editar"
                                        data-target="#UpdateOrCreateHeadquartersModal" data-backdrop="static"
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
                        No hay más sedes
                    </div>
                    <div slot="no-results">
                        No hay sedes
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
    name: "Headquarter",
    data() {
        return {
            FormHeadquarters: {
                name: null,
                in_charge: null,
                type: '',
                delegation: null,
                municipality: null
            },
            id: '',
            update: true,
            filterDelagations: false,
            validateDelegation: false,
            page: 1,
            list: [],
            permissions: [],
            url: null,
            infiniteId: +new Date(),
            delegations: [],
            municipalities: [],
            types: [],
            searchInput: '',
            setTimeoutSearch: '',
            errors: null,
            user: null,
            delegations_model: null,
            municipalities_model: null,

        }
    },
    methods: {
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/headquarters/getHeadquarters";
            axios.get(api, { params: { page: this.page, search: this.searchInput } }).then(({ data }) => {
                if (data.headquarters.data.length > 0) {
                    this.page += 1;
                    this.list.push(...data.headquarters.data);
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
            this.municipalities_model = null;
            this.changeType();
            this.setAuthenticatedUser()
        },
        queryFilter($state) {
            let api = "/g-environmental-rnec/headquarters/getHeadquarters";
            axios.get(api, {
                params: {
                    search: this.searchInput,
                    delegations_model: this.delegations_model,
                    municipalities_model: this.municipalities_model,
                }
            }).then(({ data }) => {
                // VACIO EL ARRAY PARA MOSTRAR LOS RESULTADOS DEL FILTRO
                for (let i = this.list.length; i > 0; i--) this.list.pop();

                // PINTO NUEVAMENTE LOS DATOS SEGÚN LOS FILTROS
                if (data.headquarters.data.length > 0) {
                    this.list.push(...data.headquarters.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.response(error) : ""));
        },
        createOrUpdate() {
            let url = this.update ? '/g-environmental-rnec/headquarters/' + this.id + '/update' : '/g-environmental-rnec/headquarters/store';
            axios.post(url, this.FormHeadquarters)
                .then(response => {
                    this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                    if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.headquarter.id)), 1);
                    else this.resetFormHeadquarters();
                    this.list.unshift(response.data.headquarter); // unshift sirve para agregar el elemento al array al inicio, push lo agrega al final
                }).catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        resetFormHeadquarters() {
            this.$data["FormHeadquarters"] = this.$options.data.call(this)["FormHeadquarters"];
            this.url = null;
            this.setAuthenticatedUser();
            this.validateDelegation = true;
        },
        writeData(data = {}) {
            if (this.update) {
                this.id = data.id;
                this.FormHeadquarters.name = data.name.toUpperCase();;
                this.FormHeadquarters.in_charge = data.in_charge.toUpperCase();
                this.FormHeadquarters.type = data.type.toUpperCase();
                this.FormHeadquarters.delegation = {
                    code: data.delegation.id,
                    label: data.delegation.name,
                };
                this.FormHeadquarters.municipality = {
                    code: data.municipality.id,
                    label: data.municipality.city_name,
                };
            }
        },
        validateFormHeadquarters() {
            let disabled = Object.keys(this.FormHeadquarters).every(key => (this.FormHeadquarters[key] !== null && this.FormHeadquarters[key] !== undefined && this.FormHeadquarters[key] !== ""));
            return !disabled;
        },
        setPermissions() {
            axios.post("/g-environmental-rnec/home/permissions")
                .then(response => this.permissions = response.data)
                .catch(errors => console.log(errors));
        },
        setAuthenticatedUser() {
            axios.post("/g-environmental-rnec/users/getAuthenticatedUser")
                .then(response => {
                    this.user = response.data
                    this.delegations_model = { code: response.data.delegation.id, label: response.data.delegation.name }
                    this.municipalities_model = { code: response.data.municipality.id, label: response.data.municipality.city_name }
                    this.FormHeadquarters.delegation = { code: response.data.delegation.id, label: response.data.delegation.name }
                    this.FormHeadquarters.municipality = { code: response.data.municipality.id, label: response.data.municipality.city_name }
                }).catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        setDelegations(search) {
            axios.get('/g-environmental-rnec/delegations/getDelegations', { params: { search: search } })
                .then(res => this.delegations = res.data.data)
                .catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        setMunicipalitiesFilter(search) {
            let delegation = null;
            delegation = (this.filterDelagations == true) ? this.delegations_model : this.FormHeadquarters.delegation;
            axios.get('/g-environmental-rnec/municipalities/getMunicipalities', { params: { search: search, delegation: delegation, filter: true } })
                .then(res => this.municipalities = res.data.data)
                .catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        setTypes() {
            this.types = ['CENTRAL', 'DISTRITAL', 'AUXILIAR', 'ESPECIAL', 'MUNICIPAL'];
        },
        alertLoading(time, msg, type) {
            this.$toastr.Add({
                timeout: time,
                type: type,
                msg: msg,
            });
        },
        responseErrors(error) {
            if (error.response.status === 422) {
                // CAPTURA DE ERRORES DESDE EL BACKEND
                let msg = ''

                // RECORRE TODOS LOS ERRORES Y LOS ADJUNTA EN UNA VARIABLE
                Object.values(error.response.data.errors)
                    .map((errors, index) =>
                        msg += `<li style="margin-bottom: 10px !important;"><b>${index + 1}.</b> ${errors[0]}</li>`)

                // ALERTA QUE MUESTRA AL USUARIO FINAL LOS ERRORES
                this.$swal({
                    icon: 'error', // ICONO
                    title: '¡Hola! te invitamos a que revises tús campos', // TÍTULO DE LA NOTIFICACIÓN
                    html: `<ul class="text-danger text-left">${msg}</ul>`, // CONTENIDO DE LA NOTIFICACIÓN
                    showConfirmButton: true, // BOTON DE CONFIRMACIÓN PARA CERRAR LA VENTANA
                    timer: 15000, // 15 SEG PARA QUE EL USUARIO LEA
                    timerProgressBar: true, // PERMITE LA VISUALIZACIÓN DE UNA BARRA QUE VA INDICNDO CUANDO TIEMPO FALTA PARA QUE LA VENTANA DSE CIERRE
                })
            }

            if (error.response.status === 500) {
                this.$swal({
                    icon: 'warning', // ICONO
                    title: 'Oops!', // TÍTULO DE LA NOTIFICACIÓN
                    html: '<p>Ocurrio un error con el servidor...</p>' +
                        '<p class="text-justify"><b class="text-warning">ADVERTENCIA:</b> ' + error.response.data.msg + '</p>', // CONTENIDO DE LA NOTIFICACIÓN
                    showConfirmButton: true, // BOTON DE CONFIRMACIÓN PARA CERRAR LA VENTANA
                    timer: 15000, // 15 SEG PARA QUE EL USUARIO LEA
                    timerProgressBar: true, // PERMITE LA VISUALIZACIÓN DE UNA BARRA QUE VA INDICNDO CUANDO TIEMPO FALTA PARA QUE LA VENTANA DSE CIERRE
                });
            }
        },

    },
    created() {
        this.setAuthenticatedUser();
        this.setDelegations();
        this.setMunicipalitiesFilter(false);
        this.setPermissions();
        this.setTypes();
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
