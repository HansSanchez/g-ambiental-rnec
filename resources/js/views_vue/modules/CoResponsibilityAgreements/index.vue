<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_co_responsibility_agreements === 'browse_co_responsibility_agreements' ||
        permissions.read_co_responsibility_agreements === 'read_co_responsibility_agreements' ||
        permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
        permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
        permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'"
        class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link :to="{ name: 'co-responsibility-agreements-index' }">
                                    <b>Acuerdos de Corresponsabilidad</b>
                                </router-link>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body" style="background: #d7d7d7 !important;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!-- ENCABEZADO (BOTONES Y FILTROS) -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0 mb-sm-1"
                            v-if="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements'">
                            <button @click="update = false; resetFormCoResponsibilityAgreements(); openModal();"
                                type="button" data-toggle="modal"
                                data-target="#UpdateOrCreateCoResponsibilityAgreementsModal" data-backdrop="static"
                                data-dismiss="modal" class="btn btn-success text-uppercase tip-customer btn-new w-100"
                                title="Nueva registro">
                                <v-icon color="#FFFFFF">mdi-plus-circle</v-icon>
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0 mb-sm-1">
                            <div class="form-group mb-0">
                                <select class="form-control" name="state" id="state" v-model="stateFilter"
                                    @change="queryFilter()">
                                    <option value="" selected disabled>ESTADO...</option>
                                    <option>VIGENTE</option>
                                    <option>NO VIGENTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 w-100 pt-0 mb-0 pb-sm-0 pb-xs-0 mb-sm-1">
                            <div class="input-group">
                                <input type="search" style="border-right: none !important;" v-model="searchInput"
                                    id="search" class="form-control" @change="changeType" placeholder="Buscar...">
                                <span class="input-group-text border-search bg-info" title="Buscar" @click="$emit('Enter')">
                                    <i class="fa-solid fa-search text-white"></i>
                                </span>
                                <span
                                    v-if="permissions.generate_report_co_responsibility_agreements === 'generate_report_co_responsibility_agreements'"
                                    class="input-group-text border-search bg-success" title="Generación de reportes"
                                    data-toggle="modal" data-backdrop="static" data-target="#GenerateReportModal"
                                    @click="report = true;">
                                    <i class="fa-solid fa-file-excel text-white"></i>
                                </span>
                                <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                                    <i class="fa-solid fa-rotate text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_co_responsibility_agreements === 'filter_headquarters_co_responsibility_agreements'"
                                class="form-group mb-0">
                                <v-select :options="delegations" @search="setDelegations" @input="queryFilter();
                                municipalities_model = null; headquarters_model = null
                                municipalities = []; setMunicipalitiesFilter();" v-model="delegations_model"
                                    placeholder="DELEGACIONES...">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_co_responsibility_agreements === 'filter_headquarters_co_responsibility_agreements'"
                                class="form-group mb-0">
                                <v-select :options="municipalities" v-model="municipalities_model"
                                    @search="setMunicipalitiesFilter"
                                    @input="queryFilter(); headquarters_model = null; headquarters = []; setHeadquartersFilter();"
                                    placeholder="MUNICIPIOS..." :disabled="delegations_model === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-3 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_co_responsibility_agreements === 'filter_headquarters_co_responsibility_agreements'"
                                class="form-group mb-0">
                                <v-select :options="headquarters" v-model="headquarters_model"
                                    @search="setHeadquartersFilter" @input="queryFilter();" placeholder="SEDES..."
                                    :disabled="municipalities_model === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pt-0 mb-0 pb-sm-3 pb-1-5-rem">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" v-model="dateFilter" @change="queryFilter()">
                            </div>
                        </div>
                    </div>
                    <!-- ENCABEZADO (BOTONES Y FILTROS) -->

                    <!-- NOTE START MODEALES -->

                    <!-- START CREACIÓN Y ACTUALIZACIÓN -->
                    <div v-show="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                        permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements'"
                        class="modal fade-scale" id="UpdateOrCreateCoResponsibilityAgreementsModal" tabindex="-1"
                        role="dialog" aria-labelledby="UpdateOrCreateCoResponsibilityAgreementsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e;">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>{{ update ? 'Actualizar' : 'Nuevo' }} Registro</b>
                                    </h5>
                                    <button type="button" class="close" @click="closeModal();" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff;">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body bv-modal">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
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
                                                            Tenga en cuenta que, los campos marcados con
                                                            <b class='text-danger'>(*)</b> son de caracter obligatorio.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general pb-3">
                                                        <strong>
                                                            Podrá seleccionar una o varias sedes a las cuales les aplique el
                                                            acuerdo de corresponsabilidad que va a registrar,
                                                            asimismo podrá asociar a uno o varios gestores ambientales.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general pb-3">
                                                        <strong>
                                                            Existiran casos en los cuales una o varias sedes tengan más de
                                                            un acuerdo vigente, lo invitamos a validar dicha vigencia antes
                                                            de registrar un nuevo acuerdo de corresponsabilidad.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general">
                                                        <strong>
                                                            Si tiene alguna duda con respecto a la creación de registros
                                                            asociados a los acuerdos de corresponsabilidad
                                                            lo invitamos a contactar con: "SEDE CENTRAL - BOGOTÁ".
                                                        </strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                            <ValidationProvider name="number_of_trees_planted" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>SEDE(S) <span class="text-danger">*</span></b></h5>
                                                        <v-select :options="headquarters" @search="setHeadquartersFilter"
                                                            v-model="FormCoResponsibilityAgreements.headquarters"
                                                            placeholder="SEDES..." multiple>
                                                        </v-select>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em>
                                                                Escoja la(s) sede(s) a la(s) cual(es) el acuerdo de
                                                                corresponsabilidad le(s) aplica
                                                            </em>
                                                        </b>
                                                    </small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            <h5 style="margin-bottom: 15px !important;">
                                                <b>ESTADO</b>
                                            </h5>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" v-model="FormCoResponsibilityAgreements.state"
                                                    class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">
                                                    <b>VIGENTE</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="users" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>GESTOR(ES) AMBIENTAL(ES) <span
                                                                    class="text-danger">*</span></b></h5>
                                                        <v-select :options="users" @search="getUsersInput"
                                                            v-model="FormCoResponsibilityAgreements.users"
                                                            placeholder="GESTORES..." multiple>
                                                        </v-select>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em>
                                                                Escoja el o los gestor(es) ambiental(es) involucrado(s)
                                                            </em>
                                                        </b>
                                                    </small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="environmental_operator" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>OPERADOR AMBIENTAL <span class="text-danger">*</span></b>
                                                        </h5>
                                                        <input
                                                            v-model="FormCoResponsibilityAgreements.environmental_operator"
                                                            type="text" name="environmental_operator"
                                                            id="environmental_operator" class="form-control"
                                                            placeholder="Nombre de la (Asociación de recicladores / Empresa / Gestor autorizado)"
                                                            required>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em>
                                                                Digite el nombre del operador ambiental
                                                            </em>
                                                        </b>
                                                    </small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="date" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>FECHA <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormCoResponsibilityAgreements.date" type="date"
                                                            name="date" id="date" class="form-control"
                                                            placeholder="Fecha de firmado" required>
                                                    </div>
                                                    <small><b><em>Digite la fecha de firmado</em></b></small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>OBSERVACIONES Y CAMBIOS <span class="text-danger">*</span></b>
                                            </h5>
                                            <vue-editor style="background: #fff !important; margin-top: 10px;"
                                                v-model="FormCoResponsibilityAgreements.observations"></vue-editor>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" @click="closeModal();" small class="btn btn-danger text-white"
                                        data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                    <v-btn type="button"
                                        v-if="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                                            permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements'"
                                        @click="createOrUpdate(); closeModal();" color="#2eb85c" small
                                        :disabled="validateFormCoResponsibilityAgreements()"
                                        class="btn btn-success text-uppercase text-white" data-dismiss="modal">
                                        <b>{{ update ? 'Actualizar' : 'Guardar' }}</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CREACIÓN Y ACTUALIZACIÓN -->

                    <!-- START EVIDENCIAS -->
                    <div v-show="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                        permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements'"
                        class="modal fade-scale" id="EvidencesCoResponsibilityAgreementsModal" tabindex="-1" role="dialog"
                        aria-labelledby="EvidencesCoResponsibilityAgreementsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e;">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>SUBIR EVIDENCIAS</b>
                                    </h5>
                                    <button type="button" class="close" @click="clearDropzone();" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff;">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body bv-modal">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
                                                            Asegúrese de que los documentos estén en formato:
                                                            <b class="text-danger">.pdf</b>.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general">
                                                        <strong>
                                                            Por último, podrás cargar un máximo de 2 archivos
                                                            simultáneamente.
                                                        </strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>EVIDENCIAS</b></h5>
                                            <vue-dropzone :options="dropzoneOptions" :useCustomSlot="true" id="vue-dropzone"
                                                :duplicateCheck="true" ref="myDropzone" @vdropzone-success="handleSuccess">
                                                <div class="dropzone-custom-content">
                                                    <h3 class="dropzone-custom-title">¡Arrastra y suelta para subir
                                                        contenido!</h3>
                                                    <div class="subtitle">...o haga clic para seleccionar un archivo de su
                                                        computadora o dispositivo movil
                                                    </div>
                                                </div>
                                            </vue-dropzone>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>ARCHIVOS ADJUNTOS</b></h5>
                                            <div class="table-responsive">
                                                <table id="sub_area-table"
                                                    class="table table-sm table-bordered table-striped table-condensed bg-white">
                                                    <thead class="bg-orange headerStatic">
                                                        <tr class="text-center">
                                                            <th class="tt-espumados">EVIDENCIA</th>
                                                            <th class="tt-espumados">REGISTRADO</th>
                                                            <th class="tt-espumados"
                                                                v-if="permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
                                                                    permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'">
                                                                OPCIÓN
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(itemDocument, indexDocument) in evidences"
                                                            :key="indexDocument">
                                                            <td class="text-lowercase text-left">
                                                                <a :href="'/storage/co_responsibility_agreements/evidences/documents/' + itemDocument.file"
                                                                    download>
                                                                    <b class="text-black">{{ itemDocument.name }}</b>
                                                                </a>
                                                            </td>
                                                            <td class="text-lowercase text-center">
                                                                {{ itemDocument.CreatedLabel }}
                                                            </td>
                                                            <td v-if="permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
                                                                permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'"
                                                                class="text-center justify-content-center">
                                                                <div class="btn-group" role="group">
                                                                    <span class="text-success cursor-pointer"
                                                                        title="Descargar adjunto">
                                                                        <a :href="'/storage/co_responsibility_agreements/evidences/documents/' + itemDocument.file"
                                                                            :download="itemDocument.name">
                                                                            <i class="fa-solid fa-download fa-2x pr-2"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span @click="destroyDocument(itemDocument)"
                                                                        title="Eliminar adjunto"
                                                                        class="text-danger cursor-pointer">
                                                                        <i class="fas fa-trash-alt fa-2x"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" @click="clearDropzone();" small class="btn btn-danger text-white"
                                        data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END EVIDENCIAS -->

                    <!-- START GENERATE REPORTS -->
                    <div v-show="permissions.generate_report_co_responsibility_agreements === 'generate_report_co_responsibility_agreements'"
                        class="modal fade" id="GenerateReportModal" tabindex="-1" role="dialog"
                        aria-labelledby="GenerateReportModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>{{
                                            report ? "Reporte de Acuerdos de Corresponsabilidad" : "SIN TÍTULO"
                                        }}</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <v-icon style="color: #fff">mdi-close</v-icon>
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background: #e7e7e7">
                                    <!-- REPORTES -->
                                    <div v-if="report" class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                            <div class="alert alert-info mb-0" role="alert">
                                                <h5>
                                                    <b class="full-center">
                                                        <i class="fa-solid fa-circle-info fa-2x"></i>
                                                        <strong class="pl-2">RECOMENDACIONES:</strong>
                                                    </b>
                                                </h5>
                                                <ul class="list-general text-justify">
                                                    <li class="list-general">
                                                        <strong>
                                                            Por favor, tenga en cuenta que para generar un informe es
                                                            necesario proporcionar un valor en todos los campos marcados con
                                                            <b class='text-danger'>(*)</b>.
                                                        </strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                                            <h5 class="mb-0"><b>Fechas de firmado</b></h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                                            <div class="form-group mb-0">
                                                <small class="text-danger"><b>(Desde) *</b></small>
                                                <datepicker :language="es" v-model="FormReport.fromDay"
                                                    :disabledDates="fromDay" :inputClass="inputClass"
                                                    @change="validateFormReport" :format="customFormatter"
                                                    :placeholder="fromPlaceholder">
                                                </datepicker>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                                            <div class="form-group mb-0">
                                                <small class="text-danger"><b>(Hasta) *</b></small>
                                                <datepicker :language="es" v-model="FormReport.untilDay"
                                                    :disabledDates="untilDay" :inputClass="inputClass"
                                                    @change="validateFormReport" :format="customFormatter"
                                                    :placeholder="untilPlaceholder">
                                                </datepicker>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                                            <div class="form-group mb-0">
                                                <small class="text-danger"><b>(Delegaciones) *</b></small>
                                                <v-select :options="delegations" v-model="FormReport.delegation"
                                                    @input="FormReport.municipality = null;
                                                    FormReport.headquarter = null; municipalities = []; setMunicipalitiesFilterExport();" placeholder="Buscar...">
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                                            <div class="form-group mb-0">
                                                <small class="text-danger"><b>(Municipios) *</b></small>
                                                <v-select :options="municipalities" v-model="FormReport.municipality"
                                                    @input="FormReport.headquarter = null; headquarters = []; setHeadquartersFilterExport();"
                                                    placeholder="Buscar..."
                                                    :disabled="FormReport.delegation === null ? true : false">
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                                            <div class="form-group mb-0">
                                                <small><b>(Sedes)</b></small>
                                                <v-select :options="headquarters" v-model="FormReport.headquarter"
                                                    placeholder="Buscar..."
                                                    :disabled="FormReport.municipality === null ? true : false">
                                                </v-select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END -->
                                </div>
                                <div class="modal-footer">
                                    <v-btn v-if="report" color="#6c757d" title="Limpiar" small @click="cleanFormReport()"
                                        class="btn btn-sm btn-grey text-white text-uppercase">
                                        <b>LIMPIAR</b>
                                    </v-btn>
                                    <v-btn type="button" v-if="report" @click="generateReport('FormReport')" color="#2eb85c"
                                        small class="btn btn-success text-uppercase text-white" data-dismiss="modal"
                                        :disabled="validateFormReport()">
                                        <b>GENERAR</b>
                                    </v-btn>
                                    <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END GENERATE REPORTS -->

                    <!-- NOTE END MODEALES -->

                    <!-- TABLA DE INFORMACIÓN -->
                    <div v-if="permissions.browse_co_responsibility_agreements === 'browse_co_responsibility_agreements' ||
                        permissions.read_co_responsibility_agreements === 'read_co_responsibility_agreements' ||
                        permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
                        permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                        permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'"
                        class="table-responsive max-h-650">
                        <table id="sub_area-table"
                            class="table table-sm table-bordered table-striped table-condensed bg-white">
                            <thead class="bg-orange headerStatic">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th class="tt-espumados">ESTADO</th>
                                    <th class="tt-espumados">DELEGACIÓN</th>
                                    <th class="tt-espumados">MUNICIPIO</th>
                                    <th class="tt-espumados">SEDE(S)</th>
                                    <th class="tt-espumados">OPERADOR</th>
                                    <th class="tt-espumados">FECHA</th>
                                    <th class="tt-espumados">OBSERVACIONES</th>
                                    <th class="tt-espumados"
                                        v-if="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                                            permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
                                            permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'">
                                        OPCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in  list " :key="index">
                                    <td class="text-uppercase text-center bg-register text-white">
                                        <b>{{ item.id }}</b>
                                    </td>
                                    <td class="text- text-center" v-html="item.StateLabel"></td>
                                    <td class="text-uppercase text-center">
                                        <span class="badge badge-info text-white w-100 full-16">
                                            <b>
                                                {{
                                                    item.headquarter.delegation ?
                                                    item.headquarter.delegation.name :
                                                    'SIN DELEGACIÓN'
                                                }}
                                            </b>
                                        </span>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <span class="badge badge-info text-white w-100 full-16">
                                            <b>
                                                {{
                                                    item.headquarter.municipality ?
                                                    item.headquarter.municipality.city_name :
                                                    'SIN MUNICIPIO'
                                                }}
                                            </b>
                                        </span>
                                    </td>
                                    <td class="text- text-left">
                                        <span v-if="item.headquarters">
                                            <ul class="list-custom"
                                                v-for="(itemHeadquarter, indexHeadquarter) in item.headquarters"
                                                :key="indexHeadquarter">
                                                <li class="list-custom">{{ itemHeadquarter.name }}</li>
                                            </ul>
                                        </span>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ item.environmental_operator }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.DateLabel }}
                                    </td>
                                    <td class="text-justify" v-html="item.observations"
                                        style="max-width: 400px !important;"></td>
                                    <td v-if="permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements' ||
                                        permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'
                                        " class="text-center justify-content-center">
                                        <div class="btn-group" role="group">

                                            <!-- DETALLE DEL REGISTRO -->
                                            <router-link
                                                v-if="permissions.browse_co_responsibility_agreements === 'browse_co_responsibility_agreements'"
                                                :to="{ name: 'co-responsibility-agreements-detail', params: { id: item.id } }"
                                                class="text-info" title="Detalle">
                                                <i class="fas fa-eye fa-2x"></i>
                                            </router-link>
                                            <!-- END -->

                                            <!-- EVIDENCIAS DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span v-if="permissions.add_co_responsibility_agreements === 'add_co_responsibility_agreements' ||
                                                    permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements'
                                                    " @click="evidenceCoResponsibilityAgreements(item);"
                                                    data-toggle="modal" title="Evidencias"
                                                    data-target="#EvidencesCoResponsibilityAgreementsModal"
                                                    data-backdrop="static" class="cursor-pointer pl-2">
                                                    <i v-if="item.evidence_co_responsibility_agreement.length > 0"
                                                        class="fa-solid fa-file fa-2x text-success"></i>
                                                    <i v-else class="fa-solid fa-file fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- EDITAR DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span
                                                    v-if="permissions.edit_co_responsibility_agreements === 'edit_co_responsibility_agreements'"
                                                    @click="update = true; writeData(item); openModal();"
                                                    data-toggle="modal" title="Editar"
                                                    data-target="#UpdateOrCreateCoResponsibilityAgreementsModal"
                                                    data-backdrop="static" class="text-warning cursor-pointer pl-2">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- ELIMINAR DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span
                                                    v-if="permissions.delete_co_responsibility_agreements === 'delete_co_responsibility_agreements'"
                                                    @click="destroy(item); update = false" title="Eliminar"
                                                    class="text-danger cursor-pointer pl-2">
                                                    <i class="fas fa-trash fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler"
                            spinner="waveDots" ref="infiniteHandler">
                            <div slot="no-more">
                                No hay más registros para acuerdos de corresponsabilidad
                            </div>
                            <div slot="no-results">
                                No hay registros para acuerdos de corresponsabilidad
                            </div>
                        </infinite-loading>
                    </div>
                    <!-- TABLA DE INFORMACIÓN -->

                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <forbidden-component></forbidden-component>
    </div>
</template>

<script>
// Importanción de paquete para diseño de mapas
import InfiniteLoading from "vue-infinite-loading"; // COMPONENTE PARA HACER UN SCROLL INFITITO EL CUAL SOLO ME HACE UNA CONSULTA INICIAL DE 10 REGISTROS ESTO SE COMPLEMENTA CON EL CONTROLADOR Y UN SIMPLEPAGINATE
import { VueEditor } from "vue2-editor";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";
import moment from "moment-timezone";
import LoaderComponent from '../../../components/LoaderComponent.vue';
import MiMixin from '../../../components/mixin';

export default {
    components: {
        InfiniteLoading,
        VueEditor,
        vueDropzone: vue2Dropzone,
        Datepicker,
        LoaderComponent,
    },
    name: "CoResponsibilityAgreements",
    mixins: [MiMixin],
    data() {
        return {
            id: null,
            FormCoResponsibilityAgreements: {
                headquarters: [],
                users: [],
                environmental_operator: null,
                date: null,
                state: false,
                observations: null,
            },
            update: true,
            page: 1,
            list: [],
            permissions: [],
            infiniteId: +new Date(),
            searchInput: '',
            setTimeoutSearch: '',
            errors: null,
            delegations: [],
            municipalities: [],
            headquarters: [],
            users: [],
            delegations_model: null,
            municipalities_model: null,
            headquarters_model: null,
            dateFilter: null,
            stateFilter: "",
            update: false,
            user: null,
            evidences: [],
            co_responsibility_agreement_id: null,

            // STAR VARIABLES PARA EL DROPZONE.JS
            csrfToken: null,
            dropzoneOptions: {
                url: '/g-environmental-rnec/co-responsibility-agreements/evidences/storeDocument', // RUTA PARA ENVIAR AL CONTROLADOR
                thumbnailWidth: 200,
                addRemoveLinks: true,
                acceptedFiles: ".pdf", // RESTRINGE A DOCUMENTOS PDF
                headers: { 'X-CSRF-TOKEN': this.csrfToken }, // ENVIO DE TOKEN PARA LA PETICIÓM
                // EVENTO 'SENDING' PARA ENVIAR PARÁMETROS ADICIONALES
                sending: function (file, xhr, formData) {
                    formData.append("co_responsibility_agreement_id", this.co_responsibility_agreement_id); // AGREGAR EL VALOR DINÁMICO
                }.bind(this) // ASEGURARSE DE QUE 'THIS' SE REFIERA AL COMPONENTE VUE
            },
            fileAdded: false,
            filesAdded: false,
            success: false,
            error: false,
            removedFile: false,
            sending: false,
            successMultiple: false,
            sendingMultiple: false,
            queueComplete: false,
            uploadProgress: false,
            progress: false,
            myProgress: 0,
            ismonthed: false,
            dDrop: false,
            dStarted: false,
            dEnded: false,
            dEntered: false,
            dOver: false,
            dLeave: false,
            dDuplicate: false,
            // END VARIABLES PARA EL DROPZONE.JS

            // START VARIABLES PARA GENERACIÓN DE REPORTES
            report: false,
            es: es,
            inputClass: "w-100 bg-white text-black form-control",
            fromDay: {
                from: new Date(Date.now()),
            },
            fromPlaceholder: "Desde x fecha",
            untilDay: {
                from: new Date(Date.now()),
            },
            untilPlaceholder: "Hasta x fecha",
            FormReport: {
                // FORMREPORT, ES EL FORMULARIO QUE YO ENVÍO PARA LA GENERACIÓN DE UN REPORTE
                fromDay: null,
                untilDay: null,
                delegation: null,
                municipality: null,
                headquarter: null,
            },
            day: {
                day: new Date(Date.now()),
            },
            week: {
                week: true,
            },
            month: {
                month: true,
            },
            year: {
                year: true,
            },
            file: false,
            fileName: null,
            // END VARIABLES PARA GENERACIÓN DE REPORTES

        }
    },
    props: {
    },
    methods: {
        resetFormCoResponsibilityAgreements() {
            this.$data["FormCoResponsibilityAgreements"] = this.$options.data.call(this)["FormCoResponsibilityAgreements"];
        },
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/co-responsibility-agreements/getCoResponsibilityAgreements";
            axios.get(api, { params: { page: this.page, search: this.searchInput } })
                .then(({ data }) => {
                    if (data.coResponsibilityAgreements.data.length > 0) {
                        this.page += 1;
                        this.list.push(...data.coResponsibilityAgreements.data);
                        $state.loaded();
                    } else $state.complete();
                }).catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        queryFilter($state) {
            let api = "/g-environmental-rnec/co-responsibility-agreements/getCoResponsibilityAgreements";
            axios.get(api, {
                params: {
                    search: this.searchInput,
                    delegations_model: this.delegations_model,
                    municipalities_model: this.municipalities_model,
                    headquarters_model: this.headquarters_model,
                    dateFilter: this.dateFilter,
                    stateFilter: this.stateFilter,
                }
            }).then(({ data }) => {
                // VACIO EL ARRAY PARA MOSTRAR LOS RESULTADOS DEL FILTRO
                for (let i = this.list.length; i > 0; i--) this.list.pop();

                // PINTO NUEVAMENTE LOS DATOS SEGÚN LOS FILTROS
                if (data.coResponsibilityAgreements.data.length > 0) {
                    this.list.push(...data.coResponsibilityAgreements.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        createOrUpdate() {
            let url = this.update ? '/g-environmental-rnec/co-responsibility-agreements/' + this.id + '/update' : '/g-environmental-rnec/co-responsibility-agreements/store';
            axios.post(url, this.FormCoResponsibilityAgreements)
                .then(response => {
                    this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                    if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.coResponsibilityAgreement.id)), 1);
                    this.list.unshift(response.data.coResponsibilityAgreement); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
                    this.resetFormCoResponsibilityAgreements();
                }) // ES UN MÉTODO PERSONALIZADO PARA MOSTRAR UNA ALERTA CON UN SWEETALERT
                .catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        destroy(item) {
            this.$swal({
                title: '¿Realmente desea eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    axios.delete('/g-environmental-rnec/co-responsibility-agreements/' + item.id + '/destroy')
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.list.splice(this.list.findIndex(element => (element.id === response.data.coResponsibilityAgreement.id)), 1);
                        }).catch(error => (error.response) ? this.responseErrors(error) : '');
                } else this.alertLoading(5000, "Se canceló con éxito", "info")
            });
        },
        evidenceCoResponsibilityAgreements(item) {
            this.co_responsibility_agreement_id = item.id;
            let api = "/g-environmental-rnec/co-responsibility-agreements/evidences/evidenceCoResponsibilityAgreement/" + item.id;
            axios.get(api)
                .then(({ data }) => this.evidences.push(...data.evidenceCoResponsibilityAgreements))
                .catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        storeDocument() {
            this.$refs.myDropzone.processQueue();
        },
        handleSuccess(file, response) {
            this.alertLoading(response.timeout, response.msg, response.type)
            if (!response.new) this.evidences.splice(this.evidences.findIndex(element => (element.id === response.evidenceCoResponsibilityAgreement.id)), 1);
            this.evidences.unshift(response.evidenceCoResponsibilityAgreement); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
            this.changeType();
        },
        destroyDocument(itemDocument) {
            this.$swal({
                title: '¿Realmente desea eliminar esta imagen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarla!',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    axios.delete("/g-environmental-rnec/co-responsibility-agreements/evidences/" + itemDocument.id + "/destroyDocument")
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.evidences.splice(this.evidences.findIndex(element => (element.id === response.data.evidenceCoResponsibilityAgreement.id)), 1);
                            this.changeType();
                        }).catch(error => (error.response ? this.responseErrors(error) : ""));
                } else this.alertLoading(5000, "Se canceló con éxito", "info")
            });
        },
        async writeData(data = {}) {
            /**NOTE -  CÓMO CONVERTIR STRING A FECHA PARA EDICIÓN */
            // ASIGNACIÓN DE RESPUESTA A VARIABLE
            let dateString = data.date;

            // CONVERSIÓN DE TEXTO A FECHA
            let date = new Date(dateString);

            // OBTENCIÓN DE DÍA, MES Y AÑO
            let day = date.getDate().toString().padStart(2, '0');
            let month = (date.getMonth() + 1).toString().padStart(2, '0');
            let year = date.getFullYear();

            // CONSTRUCCIÓN DE LA FECHA CON EL FORMATO
            let formattedDate = year + "-" + month + "-" + day;

            // ESCRITURA DE VALORES A VARIABLES PARA EDICIÓN
            this.id = data.id
            // MUNICIPIOS
            let headquarters_list = []
            data.headquarters.map((item) => {
                headquarters_list.push({
                    code: item.id,
                    label: item.name,
                })
            });
            this.FormCoResponsibilityAgreements.state = data.state === 'VIGENTE' ? true : false;
            this.FormCoResponsibilityAgreements.headquarters = headquarters_list;
            // GESTORES AMBIENTALES
            let users_list = []
            data.users.map((item) => {
                users_list.push({
                    code: item.id,
                    label: item.FullName,
                })
            });
            this.FormCoResponsibilityAgreements.users = users_list;
            this.FormCoResponsibilityAgreements.environmental_operator = data.environmental_operator
            this.FormCoResponsibilityAgreements.date = formattedDate
            this.FormCoResponsibilityAgreements.observations = data.observations
        },
        validateFormCoResponsibilityAgreements() {
            let disabled = Object.values(this.FormCoResponsibilityAgreements).every(value => value !== null && value !== undefined && value !== "");
            return !disabled;
        },
        validateFormReport() {
            if (!this.FormTreeReport) {
                let disabled = Object.keys(this.FormReport).every(key => key === 'headquarter' || (this.FormReport[key] !== null && this.FormReport[key] !== undefined && this.FormReport[key] !== ""));
                return !disabled;
            }
        },
        generateReport(type) {
            window.toastr.info("Generando reporte, por favor espere...", {
                timeOut: 5000,
            });
            let Form = null;
            switch (type) {
                case "FormReport":
                    Form = this.FormReport;
                    break;
                case "day":
                    Form = this.day;
                    break;
                case "week":
                    Form = this.week;
                    break;
                case "month":
                    Form = this.month;
                    break;
                case "year":
                    Form = this.year;
                    break;
            }
            const url = "/g-environmental-rnec/co-responsibility-agreements/generateReport";
            if (Form !== null) {
                let delegation = this.FormReport.delegation
                axios.post(url, { ...Form, delegation })
                    .then(this.responseReport)
                    .catch((error) => window.toastr.warning(error, { timeOut: 2000 }));
            }
            else this.alertLoading(5000, "No se aplicó ningún filtro", "error")
        },
        responseReport(response) {
            let fileName = "/storage/reports/co_responsibility_agreements/" + response.data.fileName;
            let file = response.data.file;
            if (file) {
                this.$swal({
                    icon: response.data.icon,
                    title: response.data.msg,
                    html:
                        '<a href="' +
                        fileName +
                        '" class="btn btn-success" download>' +
                        '<i class="fas fa-file-excel"></i> Descargar reporte</a>',
                    showConfirmButton: false,
                });
            } else {
                this.$swal({
                    icon: response.data.icon,
                    title: response.data.msg,
                    showConfirmButton: true,
                });
            }
        },
    },
    created() {
        this.setAuthenticatedUser();
        this.setDelegations();
        this.setMunicipalities();
        this.setHeadquartersFilter();
        this.setPermissions();
        this.getUsersInput();
        this.setCsrfToken();
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

.dropzone-custom-title {
    margin-top: 0;
    color: #00b782;
}

.subtitle {
    color: #314b5f;
}

ul.list-custom {
    list-style-type: none;
    margin: 0;
}

ul.list-custom li.list-custom {
    position: relative;
}

ul.list-custom li.list-custom:before {
    content: "\2022";
    position: absolute;
    color: black;
    position: relative;
    font-weight: bold;
    font-size: 20px;
    line-height: 30px;
    padding: 10px 10px 10px 0;
    margin-bottom: 10px;
}
</style>
