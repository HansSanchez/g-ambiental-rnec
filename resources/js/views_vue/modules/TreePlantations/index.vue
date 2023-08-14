<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_tree_plantations === 'browse_tree_plantations' ||
        permissions.read_tree_plantations === 'read_tree_plantations' ||
        permissions.edit_tree_plantations === 'edit_tree_plantations' ||
        permissions.add_tree_plantations === 'add_tree_plantations' ||
        permissions.delete_tree_plantations === 'delete_tree_plantations'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link :to="{ name: 'tree-plantations-index' }">
                                    <b>Plantación de árboles</b>
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
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0 mb-sm-5"
                            v-if="permissions.add_tree_plantations === 'add_tree_plantations'">
                            <button @click="update = false; resetFormTreePlantation(); openModal();" type="button"
                                data-toggle="modal" data-target="#UpdateOrCreateTreePlantationModal" data-backdrop="static"
                                data-dismiss="modal" class="btn btn-success text-uppercase tip-customer btn-new w-100"
                                title="Nueva registro">
                                <v-icon color="#FFFFFF">mdi-plus-circle</v-icon>
                            </button>
                            <!-- End button trigger modal -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-0">
                            <div v-if="permissions.filter_delegations_tree_plantations === 'filter_delegations_tree_plantations'"
                                class="form-group mb-0">
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
                                <span class="input-group-text border-search bg-success" title="Generación de reportes"
                                    data-toggle="modal" data-backdrop="static" data-target="#GenerateReportModal"
                                    @click="report = true;">
                                    <i class="fa-solid fa-file-excel text-white"></i>
                                </span>
                                <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                                    <i class="fa-solid fa-rotate text-white"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- ENCABEZADO (BOTONES Y FILTROS) -->

                    <!-- NOTE START MODEALES -->

                    <!-- START CREACIÓN Y ACTUALIZACIÓN -->
                    <div v-show="permissions.add_tree_plantations === 'add_tree_plantations' ||
                        permissions.edit_tree_plantations === 'edit_tree_plantations'" class="modal fade-scale"
                        id="UpdateOrCreateTreePlantationModal" tabindex="-1" role="dialog"
                        aria-labelledby="UpdateOrCreateTreePlantationModalLabel" aria-hidden="true">
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
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <ValidationProvider name="number_of_trees_planted" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>PLANTADOS <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormTreePlantation.number_of_trees_planted"
                                                            type="number" name="number_of_trees_planted"
                                                            id="number_of_trees_planted" class="form-control"
                                                            placeholder="Número de árboles" min="0" required>
                                                    </div>
                                                    <small><b><em>Digite el número de árboles que fueron
                                                                plantados</em></b></small>
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
                                                        <input v-model="FormTreePlantation.date" type="date" name="date"
                                                            id="date" class="form-control" placeholder="Fecha de plantación"
                                                            required>
                                                    </div>
                                                    <small><b><em>Digite la fecha de plantación</em></b></small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="address" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>UBICACIÓN <span class="text-danger">*</span></b></h5>
                                                        <input v-model="FormTreePlantation.address" type="text"
                                                            name="address" id="address" class="form-control"
                                                            placeholder="Nombre de la ubicación de la plantación" required>
                                                    </div>
                                                    <small><b><em>Digite el nombre de la ubicación de
                                                                plantación</em></b></small>
                                                    <small>
                                                        <p class="text-danger mb-0">
                                                            <b>{{ errors[0] }}</b>
                                                        </p>
                                                    </small>
                                                </div>
                                            </ValidationProvider>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>COORDENADAS <span class="text-danger">*</span></b></h5>
                                            <l-map v-if="modalMapVisible" style="height: 30vh" :zoom="zoom" :center="center"
                                                @click="addMarker($event)">
                                                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                                                <!-- Marcadores existentes en el array mapMarkers -->
                                                <l-marker v-for="(marker, index) in markers" :key="index"
                                                    :lat-lng="[marker.position.lat, marker.position.lng]"
                                                    :icon="getIcon(marker)" :draggable="marker.draggable"
                                                    :visible="marker.visible" @dragend="onMarkerDragEnd(index, $event)">
                                                </l-marker>
                                            </l-map>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group mb-0">
                                                        <h5><b>LATITUD</b></h5>
                                                        <input v-model="FormTreePlantation.lat" type="text" name="lat"
                                                            id="lat" class="form-control"
                                                            placeholder="Coordenada de latitud" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group mb-0">
                                                        <h5><b>LONGITUD</b></h5>
                                                        <input v-model="FormTreePlantation.lng" type="text" name="lng"
                                                            id="lng" class="form-control"
                                                            placeholder="Coordenada de longitud" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>OBSERVACIONES (ESPECIES PLANTADAS)<span class="text-danger">*</span></b>
                                            </h5>
                                            <vue-editor style="background: #fff !important; margin-top: 10px;"
                                                v-model="FormTreePlantation.observations"></vue-editor>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" @click="closeModal();" small class="btn btn-danger text-white"
                                        data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                    <v-btn type="button" v-if="permissions.add_tree_plantations === 'add_tree_plantations' ||
                                        permissions.edit_tree_plantations === 'edit_tree_plantations'"
                                        @click="createOrUpdate(); closeModal();" color="#2eb85c" small
                                        :disabled="validateFormTreePlantation()"
                                        class="btn btn-success text-uppercase text-white" data-dismiss="modal">
                                        <b>{{ update ? 'Actualizar' : 'Guardar' }}</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CREACIÓN Y ACTUALIZACIÓN -->

                    <!-- START EVIDENCIAS -->
                    <div v-show="permissions.add_tree_plantations === 'add_tree_plantations' ||
                        permissions.edit_tree_plantations === 'edit_tree_plantations'" class="modal fade-scale"
                        id="EvidencesTreePlantationModal" tabindex="-1" role="dialog"
                        aria-labelledby="EvidencesTreePlantationModalLabel" aria-hidden="true">
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
                                                            <th class="tt-espumados"
                                                                v-if="permissions.edit_tree_plantations === 'edit_tree_plantations' ||
                                                                    permissions.delete_tree_plantations === 'delete_tree_plantations'">
                                                                OPCIÓN
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(itemImage, indexImage) in evidences" :key="indexImage">
                                                            <td class="text-center">
                                                                <a :href="'/storage/tree_plantations/evidences/images/' + itemImage.file"
                                                                    download>
                                                                    <p>
                                                                        <img :src="'/storage/tree_plantations/evidences/images/' + itemImage.file"
                                                                            width="200px" height="200px">
                                                                    </p>
                                                                </a>
                                                            </td>
                                                            <td v-if="permissions.edit_tree_plantations === 'edit_tree_plantations' ||
                                                                permissions.delete_tree_plantations === 'delete_tree_plantations'"
                                                                class="text-center justify-content-center">
                                                                <div class="btn-group" role="group">
                                                                    <span @click="destroyImage(itemImage)"
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
                    <div v-show="permissions.generate_report === 'generate_report'" class="modal fade"
                        id="GenerateReportModal" tabindex="-1" role="dialog" aria-labelledby="GenerateReportModalTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #88b76e">
                                    <h5 class="modal-title text-uppercase text-white">
                                        <b>{{
                                            report ? "Reporte de plantación de árboles" : "SIN TÍTULO"
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                                            <h5 class="mb-0"><b>Fechas de plantaciones</b></h5>
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group mb-0">
                                                <small><b>(Delegaciones)</b></small>
                                                <v-select :options="delegations" v-model="FormReport.delegation"
                                                    placeholder="DELEGACIONES...">
                                                </v-select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                            <h5>RECOMENDACIONES:</h5>
                                            <ul>
                                                <li>
                                                    Tenga en cuenta que si quiere generar un reporte debe especificar el
                                                    campo
                                                    <b class="text-danger">(DESDE)</b>
                                                    y el campo
                                                    <b class="text-danger">(HASTA)</b>
                                                    de lo contrario no se permitirá, exceptuando los botones
                                                    <b class="text-info">(MENSUAL)</b> y <b class="text-info">(ANUAL)</b>.
                                                </li>
                                                <li>
                                                    <br>
                                                    Por otro lado, se deja aclaración que los botones hacen referencia al
                                                    mes y al año actual.
                                                    <br>
                                                    <br>
                                                    <b>Ejemplo:</b>
                                                    <br>
                                                    <b>
                                                        <span class="text-info">(ANUAL)</span> :
                                                        {{ getCurrentYear() }}
                                                    </b>
                                                    <br>
                                                    <b>
                                                        <span class="text-info">(MENSUAL)</span> :
                                                        {{ getCurrentDateWithSpanishMonth() }}
                                                    </b>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- END -->
                                </div>
                                <div class="modal-footer">
                                    <v-btn v-if="report" color="#6c757d" title="Limpiar" small @click="cleanFormReport()"
                                        class="btn btn-sm btn-grey text-white text-uppercase">
                                        <b>LIMPIAR</b>
                                    </v-btn>
                                    <v-btn v-if="report" color="#39f" title="Mensual" small @click="generateReport('mount')"
                                        class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal"
                                        :disabled="!validateFormReport()">
                                        <b>MENSUAL</b>
                                    </v-btn>
                                    <v-btn v-if="report" color="#39f" title="Anual" small @click="generateReport('year')"
                                        class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal"
                                        :disabled="!validateFormReport()">
                                        <b>ANUAL</b>
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
                    <div v-if="permissions.browse_tree_plantations === 'browse_tree_plantations' ||
                        permissions.read_tree_plantations === 'read_tree_plantations' ||
                        permissions.edit_tree_plantations === 'edit_tree_plantations' ||
                        permissions.add_tree_plantations === 'add_tree_plantations' ||
                        permissions.delete_tree_plantations === 'delete_tree_plantations'"
                        class="table-responsive max-h-650">
                        <table id="sub_area-table"
                            class="table table-sm table-bordered table-striped table-condensed bg-white">
                            <thead class="bg-orange headerStatic">
                                <tr class="text-center">
                                    <th class="tt-espumados">DELEGACIÓN</th>
                                    <th class="tt-espumados">PLANTADOS</th>
                                    <th class="tt-espumados">FECHA</th>
                                    <th class="tt-espumados">UBICACIÓN</th>
                                    <th class="tt-espumados">OBSERVACIONES</th>
                                    <th class="tt-espumados" v-if="permissions.add_tree_plantations === 'add_tree_plantations' ||
                                        permissions.edit_tree_plantations === 'edit_tree_plantations' ||
                                        permissions.delete_tree_plantations === 'delete_tree_plantations'">
                                        OPCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in list" :key="index">
                                    <td class="text-uppercase text-center">
                                        <span class="badge badge-info text-white w-100 full-16">
                                            <b>
                                                {{
                                                    item.delegation ?
                                                    item.delegation.name :
                                                    'SIN DELEGACIÓN'
                                                }}
                                            </b>
                                        </span>
                                    </td>
                                    <td class="text- text-center">
                                        {{ item.number_of_trees_planted }}
                                    </td>
                                    <td class="text-lowercase text-center">
                                        {{ item.DateLabel }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.address }}
                                    </td>
                                    <td class="text-justify" v-html="item.observations"
                                        style="max-width: 400px !important;"></td>
                                    <td v-if="permissions.edit_tree_plantations === 'edit_tree_plantations' ||
                                        permissions.delete_tree_plantations === 'delete_tree_plantations'"
                                        class="text-center justify-content-center">
                                        <div class="btn-group" role="group">

                                            <!-- EVIDENCIAS DEL REGISTRO -->
                                            <router-link
                                                v-if="permissions.browse_tree_plantations === 'browse_tree_plantations'"
                                                :to="{ name: 'tree-plantations-detail', params: { id: item.id } }"
                                                class="text-info" title="Detalle">
                                                <i class="fas fa-eye fa-2x"></i>
                                            </router-link>
                                            <!-- END -->

                                            <!-- EVIDENCIAS DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span v-if="permissions.add_tree_plantations === 'add_tree_plantations' ||
                                                    permissions.edit_tree_plantations === 'edit_tree_plantations'"
                                                    @click="evidenceTreePlantation(item);" data-toggle="modal"
                                                    title="Evidencias" data-target="#EvidencesTreePlantationModal"
                                                    data-backdrop="static" class="cursor-pointer pl-2">
                                                    <i v-if="item.evidence_tree_plantations.length > 0"
                                                        class="fa-solid fa-camera fa-2x text-success"></i>
                                                    <i v-else class="fa-solid fa-camera fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- EDITAR DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span v-if="permissions.edit_tree_plantations === 'edit_tree_plantations'"
                                                    @click="update = true; writeData(item); openModal();"
                                                    data-toggle="modal" title="Editar"
                                                    data-target="#UpdateOrCreateTreePlantationModal" data-backdrop="static"
                                                    class="text-warning cursor-pointer pl-2">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- ELIMINAR DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.delegation_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span
                                                    v-if="permissions.delete_tree_plantations === 'delete_tree_plantations'"
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
                                No hay más registros
                            </div>
                            <div slot="no-results">
                                No hay registros
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
import { latLng } from "leaflet";
import InfiniteLoading from "vue-infinite-loading"; // COMPONENTE PARA HACER UN SCROLL INFITITO EL CUAL SOLO ME HACE UNA CONSULTA INICIAL DE 10 REGISTROS ESTO SE COMPLEMENTA CON EL CONTROLADOR Y UN SIMPLEPAGINATE
import { VueEditor } from "vue2-editor";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";
import moment from "moment-timezone";
import LoaderComponent from '../../../components/LoaderComponent.vue';
import NotFountComponent from '../../../components/NotFountComponent.vue';

export default {
    components: {
        InfiniteLoading,
        VueEditor,
        vueDropzone: vue2Dropzone,
        Datepicker,
        LoaderComponent,
    },
    name: "TreePlantation",
    data() {
        return {
            id: null,
            FormTreePlantation: {
                number_of_trees_planted: null,
                date: null,
                address: null,
                lat: null,
                lng: null,
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
            delegations_model: [],
            dateFilter: null,
            update: false,
            user: null,
            evidences: [],
            tree_plantation_id: null,

            // STAR VARIABLES PARA EL DROPZONE.JS
            csrfToken: null,
            dropzoneOptions: {
                url: '/g-environmental-rnec/tree-plantations/evidences/storeImage', // RUTA PARA ENVIAR AL CONTROLADOR
                thumbnailWidth: 200,
                addRemoveLinks: true,
                acceptedFiles: "image/*", // RESTRINGE A IMÁGENES
                headers: { 'X-CSRF-TOKEN': this.csrfToken }, // ENVIO DE TOKEN PARA LA PETICIÓM
                // EVENTO 'SENDING' PARA ENVIAR PARÁMETROS ADICIONALES
                sending: function (file, xhr, formData) {
                    formData.append("tree_plantation_id", this.tree_plantation_id); // AGREGAR EL VALOR DINÁMICO
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
            isMounted: false,
            dDrop: false,
            dStarted: false,
            dEnded: false,
            dEntered: false,
            dOver: false,
            dLeave: false,
            dDuplicate: false,
            // END VARIABLES PARA EL DROPZONE.JS

            // START VARIABLES PARA EL MAPA
            zoom: 12,
            center: latLng(4.570868, -74.297333),
            url: "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            withPopup: latLng(4.570868, -74.297333),
            markers: [],
            currentZoom: 11.5,
            currentCenter: latLng(4.570868, -74.297333),
            mapOptions: {
                zoomSnap: 1,
            },
            markerLatLng: [4.570868, -74.297333],
            modalMapVisible: false,
            // VARIABLE PARA MANTENER LA REFERENCIA AL MARCADOR ACTUAL
            marker: null,
            // END VARIABLES PARA EL MAPA

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
                delegation: null
            },
            day: {
                day: new Date(Date.now()),
            },
            week: {
                week: true,
            },
            mount: {
                mount: true,
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
        resetFormTreePlantation() {
            this.$data["FormTreePlantation"] = this.$options.data.call(this)["FormTreePlantation"];
        },
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/tree-plantations/getTreePlantation";
            axios.get(api, { params: { page: this.page, search: this.searchInput } })
                .then(({ data }) => {
                    if (data.treePlantation.data.length > 0) {
                        this.page += 1;
                        this.list.push(...data.treePlantation.data);
                        $state.loaded();
                    } else $state.complete();
                }).catch(error => (error.response ? this.responseErrors(error) : ""));
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
            let api = "/g-environmental-rnec/tree-plantations/getTreePlantation";
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
                if (data.treePlantation.data.length > 0) {
                    this.list.push(...data.treePlantation.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        createOrUpdate() {
            let url = this.update ? '/g-environmental-rnec/tree-plantations/' + this.id + '/update' : '/g-environmental-rnec/tree-plantations/store';
            axios.post(url, this.FormTreePlantation)
                .then(response => {
                    this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                    if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.treePlantation.id)), 1);
                    this.list.unshift(response.data.treePlantation); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
                    this.resetFormTreePlantation();
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
                    axios.delete('/g-environmental-rnec/tree-plantations/' + item.id + '/destroy')
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.list.splice(this.list.findIndex(element => (element.id === response.data.treePlantation.id)), 1);
                        }).catch(error => (error.response) ? this.responseErrors(error) : '');
                } else this.alertLoading(5000, "Se canceló con éxito", "info")
            });
        },
        evidenceTreePlantation(item) {
            this.tree_plantation_id = item.id;
            let api = "/g-environmental-rnec/tree-plantations/evidences/evidenceTreePlantation/" + item.id;
            axios.get(api)
                .then(({ data }) => this.evidences.push(...data.evidenceTreePlantation))
                .catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        storeImage() {
            this.$refs.myDropzone.processQueue();
        },
        handleSuccess(file, response) {
            this.alertLoading(response.timeout, response.msg, response.type)
            if (!response.new) this.evidences.splice(this.evidences.findIndex(element => (element.id === response.evidenceTreePlantation.id)), 1);
            this.evidences.unshift(response.evidenceTreePlantation); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
        },
        clearDropzone() {
            this.evidences = [];
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
        },
        destroyImage(itemImage) {
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
                    axios.delete("/g-environmental-rnec/tree-plantations/evidences/" + itemImage.id + "/destroyImage")
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.evidences.splice(this.evidences.findIndex(element => (element.id === response.data.evidenceTreePlantation.id)), 1);
                            this.changeType();
                        }).catch(this.response);
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

            /** NOTE - CÓMO COLOCAR UN MARCADOR EN EDICION*/
            this.addMarkerUpdate(data);

            // ESCRITURA DE VALORES A VARIABLES PARA EDICIÓN
            this.id = data.id
            this.FormTreePlantation.number_of_trees_planted = data.number_of_trees_planted
            this.FormTreePlantation.date = formattedDate
            this.FormTreePlantation.address = data.address
            this.FormTreePlantation.lat = parseFloat(data.lat)
            this.FormTreePlantation.lng = parseFloat(data.lng)
            this.FormTreePlantation.observations = data.observations
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
        number_format(amount, decimals) {
            amount += ""; // POR SI PASAN UN NUMERO EN VEZ DE UN STRING
            amount = parseFloat(amount.replace(/[^0-9\.]/g, "")); // ELIMINO CUALQUIER COSA QUE NO SEA NUMERO O PUNTO
            decimals = decimals || 0; // POR SI LA VARIABLE NO FUE FUE PASADA
            // SI NO ES UN NUMERO O ES IGUAL A CERO RETORNO EL MISMO CERO
            if (isNaN(amount) || amount === 0)
                return parseFloat(0).toFixed(decimals);
            // SI ES MAYOR O MENOR QUE CERO RETORNO EL VALOR FORMATEADO COMO NUMERO
            amount = "" + amount.toFixed(decimals);
            var amount_parts = amount.split("."),
                regexp = /(\d+)(\d{3})/;
            while (regexp.test(amount_parts[0]))
                while (regexp.test(amount_parts[0]))
                    amount_parts[0] = amount_parts[0].replace(
                        regexp,
                        "$1" + "," + "$2"
                    );
            return amount_parts.join(".");
        },
        // AGREGA ESTA FUNCIÓN PARA ABRIR EL MODAL Y ESTABLECER MODALVISIBLE EN VERDADERO
        openModal() {
            this.modalMapVisible = true;
            // FORZAR UNA ACTUALIZACIÓN DEL MAPA DESPUÉS DE 100 MILISEGUNDOS
            // ESTO LE DA TIEMPO AL MODAL PARA TENER SU TAMAÑO CORRECTAMENTE DEFINIDO.
            setTimeout(() => {
                this.$refs.mapRef.invalidateSize();
            }, 5000);
        },
        // AGREGA ESTA FUNCIÓN PARA CERRAR EL MODAL Y ESTABLECER MODALVISIBLE EN FALSO
        closeModal() {
            this.modalMapVisible = false;
        },
        zoomUpdate(zoom) {
            this.currentZoom = zoom;
        },
        centerUpdate(center) {
            this.currentCenter = center;
        },
        // AGREGA ESTA FUNCIÓN PARA MANEJAR EL EVENTO DE CLIC EN EL MAPA
        addMarker(event) {
            const { lat, lng } = event.latlng; // Obtiene las coordenadas del clic
            this.FormTreePlantation.lat = lat;
            this.FormTreePlantation.lng = lng;
            this.markers = [
                {
                    position: {
                        lng: lng,
                        lat: lat,
                    },
                    visible: true,
                    draggable: true,
                }
            ]

        },
        // AGREGA ESTA FUNCIÓN PARA MANEJAR EL EVENTO DE CLIC EN EL MAPA
        addMarkerUpdate(data) {
            if (this.update) {
                this.markers = [
                    {
                        position: {
                            lng: parseFloat(data.lng),
                            lat: parseFloat(data.lat),
                        },
                        visible: true,
                        draggable: true,
                    }
                ]
                this.center = latLng(parseFloat(data.lat), parseFloat(data.lng));
            }

        },
        /*
            **NOTE - EXPLICACIÓN:
            ESTA FUNCIÓN TIENE COMO OBJETIVO CREAR UN ICONO EN SVG EL CUAL ES PERSONALIZABLE PARA EL MAPA
        */
        getIcon() {
            return L.divIcon({
                className: "my-custom-pin",
                html: `<svg class="rotate" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 34.892337" height="40" width="40">
                    <g transform="translate(-814.59595,-274.38623)">
                        <g transform="matrix(1.1855854,0,0,1.1855854,-151.17715,-57.3976)">
                        <path d="m 817.11249,282.97118 c -1.25816,1.34277 -2.04623,3.29881 -2.01563,5.13867 0.0639,3.84476 1.79693,5.3002 4.56836,10.59179 0.99832,2.32851 2.04027,4.79237 3.03125,8.87305 0.13772,0.60193 0.27203,1.16104 0.33416,1.20948 0.0621,0.0485 0.19644,-0.51262 0.33416,-1.11455 0.99098,-4.08068 2.03293,-6.54258 3.03125,-8.87109 2.77143,-5.29159 4.50444,-6.74704 4.56836,-10.5918 0.0306,-1.83986 -0.75942,-3.79785 -2.01758,-5.14062 -1.43724,-1.53389 -3.60504,-2.66908 -5.91619,-2.71655 -2.31115,-0.0475 -4.4809,1.08773 -5.91814,2.62162 z" style="fill:#008F39
                        ;stroke:#000"/>
                        <circle r="3.0355" cy="288.25278" cx="823.03064" id="path3049" style="display:inline;fill:#FFF;stroke:#000000"/>
                        </g>
                    </g>
                </svg>`,
            });
        },
        onMarkerDragEnd(index, event) {
            const { lat, lng } = event.target.getLatLng();
            console.log('Marcador', index, 'movido a:', lat, lng);
            this.FormTreePlantation.lat = lat;
            this.FormTreePlantation.lng = lng;
            this.markers[index].position = { lat, lng };
        },
        validateFormTreePlantation() {
            let disabled = Object.values(this.FormTreePlantation).every(value => value !== null && value !== undefined && value !== "");
            return !disabled;
        },
        validateFormReport() {
            if (!this.FormTreeReport) {
                let disabled = Object.keys(this.FormReport).every(key => key === 'delegation' || (this.FormReport[key] !== null && this.FormReport[key] !== undefined && this.FormReport[key] !== ""));
                return !disabled;
            }
        },
        cleanFormReport() {
            this.FormReport.fromDay = null;
            this.FormReport.untilDay = null;
            this.setAuthenticatedUser();
        },
        customFormatter(date) {
            return moment(date).format("DD/MMMM/YYYY");
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
                case "mount":
                    Form = this.mount;
                    break;
                case "year":
                    Form = this.year;
                    break;
            }
            const url = "/g-environmental-rnec/tree-plantations/generateReport";
            if (Form !== null) {
                let delegation = this.FormReport.delegation
                axios.post(url, { ...Form, delegation })
                    .then(this.responseReport)
                    .catch((error) => window.toastr.warning(error, { timeOut: 2000 }));
            }
            else this.alertLoading(5000, "No se aplicó ningún filtro", "error")
        },
        responseReport(response) {
            let fileName = "/storage/reports/tree_plantations/" + response.data.fileName;
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
        getSpanishMonthName(month) {
            const spanishMonthNames = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];
            return spanishMonthNames[month];
        },
        getCurrentDateWithSpanishMonth() {
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth();
            const monthName = this.getSpanishMonthName(currentMonth);
            return monthName;
        },
        getCurrentYear() {
            const currentDate = new Date();
            return currentDate.getFullYear();
        },
        setCsrfToken() {
            axios.get("/g-environmental-rnec/csrf-token")
                .then(response => this.dropzoneOptions.headers['X-CSRF-TOKEN'] = response.data)
                .catch(error => (error.response) ? this.responseErrors(error) : '');
        },
        setAuthenticatedUser() {
            axios.post("/g-environmental-rnec/users/getAuthenticatedUser")
                .then(response => {
                    this.user = response.data
                    this.FormReport.delegation = { code: response.data.delegation.id, label: response.data.delegation.name }
                })
                .catch(errors => console.log(errors));
        },
        setPermissions() {
            axios.post("/g-environmental-rnec/home/permissions")
                .then(response => this.permissions = response.data)
                .catch(errors => console.log(errors));
        },
        setDelegations(search) { // Función para traer las sociedades en un v-select
            axios.get('/g-environmental-rnec/delegations/getDelegations', { params: { search: search } })
                .then(res => this.delegations = res.data.data)
                .catch(error => (error.response) ? this.responseErrors(error) : '');
        },
    },
    created() {
        this.setAuthenticatedUser();
        this.setPermissions();
        this.setDelegations();
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
</style>
