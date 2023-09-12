<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_electrical_consumptions === 'browse_electrical_consumptions' ||
        permissions.read_electrical_consumptions === 'read_electrical_consumptions' ||
        permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
        permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
        permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link :to="{ name: 'electrical-consumptions-index' }">
                                    <b>CONSUMOS ELÉCTRICOS</b>
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
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_electrical_consumptions === 'filter_headquarters_electrical_consumptions'"
                                class="form-group mb-0">
                                <v-select :options="delegations" @search="setDelegations" @input="queryFilter();
                                municipalities_model = null; headquarters_model = null
                                municipalities = []; setMunicipalitiesFilter();" v-model="delegations_model"
                                    placeholder="DELEGACIONES...">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_electrical_consumptions === 'filter_headquarters_electrical_consumptions'"
                                class="form-group mb-0">
                                <v-select :options="municipalities" v-model="municipalities_model"
                                    @search="setMunicipalitiesFilter"
                                    @input="queryFilter(); headquarters_model = null; headquarters = []; setHeadquartersFilter();"
                                    placeholder="MUNICIPIOS..." :disabled="delegations_model === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-0 mb-0 pb-sm-1 pb-xs-1">
                            <div v-if="permissions.filter_headquarters_electrical_consumptions === 'filter_headquarters_electrical_consumptions'"
                                class="form-group mb-0">
                                <v-select :options="headquarters" v-model="headquarters_model"
                                    @search="setHeadquartersFilter" @input="queryFilter();" placeholder="SEDES..."
                                    :disabled="municipalities_model === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-0 mb-0 pb-sm-0 pb-xs-1">
                            <div class="form-group mb-0">
                                <select class="form-control" name="year" id="year" v-model="yearFilter"
                                    @change="queryFilter()">
                                    <option value="" selected disabled>AÑOS...</option>
                                    <option v-for="(item, index) in  years" :key="index">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-0 mb-0 pb-sm-3 pb-xs-1">
                            <div class="form-group mb-0">
                                <select class="form-control" name="month" id="month" v-model="monthFilter"
                                    @change="queryFilter()">
                                    <option value="" selected disabled>MESES...</option>
                                    <option v-for="(item, index) in  months" :key="index">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 w-100 pt-0 mb-0 pb-sm-3 pb-1-5-rem">
                            <div class="input-group">
                                <input type="search" style="border-right: none !important;" v-model="searchInput"
                                    id="search" class="form-control" @change="changeType" placeholder="Buscar...">
                                <span class="input-group-text border-search bg-info" title="Buscar" @click="$emit('Enter')">
                                    <i class="fa-solid fa-search text-white"></i>
                                </span>
                                <span
                                    v-if="permissions.generate_report_electrical_consumptions === 'generate_report_electrical_consumptions'"
                                    class="input-group-text border-search bg-success" title="Generación de reportes"
                                    data-toggle="modal" data-backdrop="static" data-target="#GenerateReportModal"
                                    @click="createFuntions()">
                                    <i class="fa-solid fa-file-excel text-white"></i>
                                </span>
                                <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                                    <i class="fa-solid fa-rotate text-white"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- NOTE START MODEALES -->

                    <!-- START CREACIÓN Y ACTUALIZACIÓN -->
                    <div v-show="permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                        permissions.edit_electrical_consumptions === 'edit_electrical_consumptions'"
                        class="modal fade-scale" id="UpdateOrCreateElectricalConsumptionsModal" tabindex="-1" role="dialog"
                        aria-labelledby="UpdateOrCreateElectricalConsumptionsLabel" aria-hidden="true">
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
                                                            En este módulo, solo sebe registrar el valor de los
                                                            <b><strong class="text-info">KILOWATTS (MES)</strong></b>,
                                                            <b><strong class="text-info">TOTAL DE PERSONAL</strong></b>
                                                            y si lo consideras necesario, agregar
                                                            <b><strong class="text-info">OBSERVACIONES</strong></b>; de lo
                                                            contrario, puedes dejar el texto predeterminado.
                                                        </strong>
                                                    </li>
                                                    <li class="list-general">
                                                        <strong>
                                                            Si tiene alguna duda con respecto a la creación de registros
                                                            asociados a los consumos eléctricos
                                                            lo invitamos a contactar con: "SEDE CENTRAL - BOGOTÁ".
                                                        </strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ValidationProvider name="number_of_trees_planted" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>SEDE <span class="text-danger">*</span></b></h5>
                                                        <v-select :options="headquarters" @search="setHeadquarters"
                                                            v-model="FormElectricalConsumptions.headquarter"
                                                            placeholder="SEDES..."
                                                            :disabled="FormElectricalConsumptions.headquarter !== null ? true : false">
                                                        </v-select>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em class="text-info">
                                                                Por defecto, solo podrás ver y editar los registros de la
                                                                sede a la cual perteneces.
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
                                            <ValidationProvider name="year" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>AÑO <span class="text-danger">*</span></b></h5>
                                                        <div class="form-group mb-0">
                                                            <select class="form-control" name="year" id="year"
                                                                v-model="FormElectricalConsumptions.year"
                                                                :disabled="FormElectricalConsumptions.year !== null ? true : false">
                                                                <option v-for="(item, index) in  years" :key="index">
                                                                    {{ item }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em class="text-info">
                                                                Por defecto, solo podrás ver y editar los registros del año
                                                                que pertenece el registro
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
                                            <ValidationProvider name="month" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5><b>MES <span class="text-danger">*</span></b></h5>
                                                        <div class="form-group mb-0">
                                                            <select class="form-control" name="month" id="month"
                                                                v-model="FormElectricalConsumptions.month"
                                                                :disabled="FormElectricalConsumptions.month !== null ? true : false">
                                                                <option v-for="(item, index) in  months" :key="index">
                                                                    {{ item }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em class="text-info">
                                                                Por defecto, solo podrás ver y editar los registros del mes
                                                                que pertenece el registro
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
                                            <ValidationProvider name="kw_monthly" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5>
                                                            <b>KILOWATTS (MES) <span class="text-danger">*</span></b>
                                                        </h5>
                                                        <input v-model="FormElectricalConsumptions.kw_monthly" type="number"
                                                            name="kw_monthly" min="1" id="kw_monthly" class="form-control"
                                                            placeholder="Nombre del gestor(a) ambiental" required>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em>
                                                                Digite la cantidad de kilowatts del mes
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
                                            <ValidationProvider name="total_staff" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <div class="form-group mb-0">
                                                        <h5>
                                                            <b>TOTAL DE PERSONAL <span class="text-danger">*</span></b>
                                                        </h5>
                                                        <input v-model="FormElectricalConsumptions.total_staff"
                                                            type="number" name="total_staff" min="0" id="total_staff"
                                                            class="form-control"
                                                            placeholder="Nombre del gestor(a) ambiental" required>
                                                    </div>
                                                    <small>
                                                        <b>
                                                            <em>
                                                                Digite la cantidad total de personal
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>OBSERVACIONES <span class="text-danger">*</span></b>
                                            </h5>
                                            <vue-editor style="background: #fff !important; margin-top: 10px;"
                                                v-model="FormElectricalConsumptions.observations"></vue-editor>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <v-btn color="#e55353" @click="closeModal();" small class="btn btn-danger text-white"
                                        data-dismiss="modal">
                                        <b>CANCELAR</b>
                                    </v-btn>
                                    <v-btn type="button"
                                        v-if="permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                                            permissions.edit_electrical_consumptions === 'edit_electrical_consumptions'"
                                        @click="createOrUpdate(); closeModal();" color="#2eb85c" small
                                        :disabled="validateFormElectricalConsumptions()"
                                        class="btn btn-success text-uppercase text-white" data-dismiss="modal">
                                        <b>{{ update ? 'Actualizar' : 'Guardar' }}</b>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CREACIÓN Y ACTUALIZACIÓN -->

                    <!-- START EVIDENCIAS -->
                    <div v-show="permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                        permissions.edit_electrical_consumptions === 'edit_electrical_consumptions'"
                        class="modal fade-scale" id="EvidencesElectricalConsumptionsModal" tabindex="-1" role="dialog"
                        aria-labelledby="EvidencesElectricalConsumptionsModalLabel" aria-hidden="true">
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
                                            <recommendations-component :tree_plantation="false"></recommendations-component>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h5><b>EVIDENCIAS</b></h5>
                                            <vue-dropzone :options="dropzoneOptions" :useCustomSlot="true" id="vue-dropzone"
                                                :duplicateCheck="true" ref="myDropzone" @vdropzone-success="handleSuccess">
                                                <div class="dropzone-custom-content">
                                                    <h3 class="dropzone-custom-title">
                                                        ¡Arrastrar el contenido aquí!
                                                    </h3>
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
                                                            <th>EVIDENCIA</th>
                                                            <th>REGISTRADO</th>
                                                            <th
                                                                v-if="permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
                                                                    permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'">
                                                                OPCIÓN
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(itemEvidence, indexEvidence) in evidences"
                                                            :key="indexEvidence">
                                                            <td class="text-left">
                                                                <a v-if="itemEvidence.extension === 'jpg' || itemEvidence.extension === 'png'
                                                                    || itemEvidence.extension === 'jpeg' || itemEvidence.extension === 'gif'
                                                                    || itemEvidence.extension === 'bmp' || itemEvidence.extension === 'tiff'
                                                                    || itemEvidence.extension === 'tif' || itemEvidence.extension === 'webp'
                                                                    || itemEvidence.extension === 'svg' || itemEvidence.extension === 'raw'"
                                                                    :href="'/storage/electrical_consumptions/evidences/files/' + itemEvidence.file"
                                                                    download>
                                                                    <p>
                                                                        <img :src="'/storage/electrical_consumptions/evidences/files/' + itemEvidence.file"
                                                                            width="200px" height="200px">
                                                                    </p>
                                                                </a>
                                                                <a v-else
                                                                    :href="'/storage/electrical_consumptions/evidences/files/' + itemEvidence.file"
                                                                    download>
                                                                    <b class="text-black">{{ itemEvidence.name }}</b>
                                                                </a>
                                                            </td>
                                                            <td class="text-lowercase text-center">
                                                                {{ itemEvidence.CreatedLabel }}
                                                            </td>
                                                            <td v-if="permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
                                                                permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'"
                                                                class="text-center justify-content-center">
                                                                <div class="btn-group" role="group">
                                                                    <span class="text-success cursor-pointer"
                                                                        title="Descargar adjunto">
                                                                        <a :href="'/storage/electrical_consumptions/evidences/files/' + itemEvidence.file"
                                                                            :download="itemEvidence.name">
                                                                            <i class="fa-solid fa-download fa-2x pr-2"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span @click="destroyEvidence(itemEvidence)"
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
                    <GenerateReportModalComponent
                        v-show="permissions.generate_report_electrical_consumptions === 'generate_report_electrical_consumptions'"
                        :permissions="permissions" :title="'Reporte de consumos eléctricos'" :title_2="'Fechas de consumo'"
                        :url="'/g-environmental-rnec/electrical-consumptions/generateReport'"
                        :fileName="'/storage/reports/electrical_consumptions/'" :delegationsExport="delegations_export"
                        :municipalitiesExport="municipalities_export" :headquartersExport="headquarters_export"
                        :other="true" :electrical="true" :water="false" :waste="false"/>

                    <!-- NOTE END MODEALES -->

                    <!-- TABLA DE INFORMACIÓN -->
                    <div v-if="permissions.browse_electrical_consumptions === 'browse_electrical_consumptions' ||
                        permissions.read_electrical_consumptions === 'read_electrical_consumptions' ||
                        permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
                        permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                        permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'"
                        class="table-responsive max-h-650">
                        <table id="sub_area-table"
                            class="table table-sm table-bordered table-striped table-condensed bg-white">
                            <thead class="bg-orange headerStatic">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>DELEGACIÓN - MUNICIPIO - SEDE</th>
                                    <th>GESTOR</th>
                                    <th>AÑO</th>
                                    <th>MES</th>
                                    <th>KILOWATTS</th>
                                    <th>PERSONAL</th>
                                    <th>OBSERVACIONES</th>
                                    <th
                                        v-if="permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                                            permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
                                            permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'">
                                        OPCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in  list " :key="index">
                                    <td class="text-uppercase text-center bg-register text-white">
                                        <b>{{ item.id }}</b>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <b>
                                            {{
                                                item.headquarter ?
                                                item.headquarter.delegation.name + " - " +
                                                item.headquarter.municipality.city_name + " - " +
                                                item.headquarter.name :
                                                'SIN SEDE'
                                            }}
                                        </b>
                                    </td>
                                    <td class="text- text-center">
                                        {{ item.user.FullName }}
                                    </td>
                                    <td class="text-center bg-register-bold">
                                        {{ item.year }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success w-100 full-16">
                                            <strong>{{ item.month }}</strong>
                                        </span>
                                    </td>
                                    <td v-if="item.kw_monthly > 0" class="text-center bg-register-bold">
                                        {{ number_format(item.kw_monthly) }}
                                    </td>
                                    <td v-else class="text-center bg-warning-bold">
                                        {{ number_format(item.kw_monthly) }}
                                    </td>
                                    <td v-if="item.total_staff > 0" class="text-center bg-register-bold">
                                        {{ number_format(item.total_staff) }}
                                    </td>
                                    <td v-else class="text-center bg-warning-bold">
                                        {{ number_format(item.total_staff) }}
                                    </td>
                                    <td class="text-justify" v-html="item.observations"
                                        style="max-width: 400px !important;"></td>
                                    <td v-if="permissions.edit_electrical_consumptions === 'edit_electrical_consumptions' ||
                                        permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'
                                        " class="text-center justify-content-center">
                                        <div class="btn-group" role="group">

                                            <!-- DETALLE DEL REGISTRO -->
                                            <router-link
                                                v-if="permissions.browse_electrical_consumptions === 'browse_electrical_consumptions'"
                                                :to="{ name: 'electrical-consumptions-detail', params: { id: item.id } }"
                                                class="text-info" title="Detalle">
                                                <i class="fas fa-eye fa-2x"></i>
                                            </router-link>
                                            <!-- END -->

                                            <!-- EVIDENCIAS DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.headquarter_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span v-if="permissions.add_electrical_consumptions === 'add_electrical_consumptions' ||
                                                    permissions.edit_electrical_consumptions === 'edit_electrical_consumptions'
                                                    " @click="evidenceElectricalConsumptions(item);"
                                                    data-toggle="modal" title="Evidencias"
                                                    data-target="#EvidencesElectricalConsumptionsModal"
                                                    data-backdrop="static" class="cursor-pointer pl-2">
                                                    <i v-if="item.evidence_electrical_consumption.length > 0"
                                                        class="fa-solid fa-file fa-2x text-success"></i>
                                                    <i v-else class="fa-solid fa-file fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- EDITAR DEL REGISTRO -->
                                            <span
                                                v-if="Number(item.headquarter_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span
                                                    v-if="permissions.edit_electrical_consumptions === 'edit_electrical_consumptions'"
                                                    @click="update = true; writeData(item); openModal();"
                                                    data-toggle="modal" title="Editar"
                                                    data-target="#UpdateOrCreateElectricalConsumptionsModal"
                                                    data-backdrop="static" class="text-warning cursor-pointer pl-2">
                                                    <i class="fas fa-edit fa-2x"></i>
                                                </span>
                                            </span>
                                            <!-- END -->

                                            <!-- ELIMINAR DEL REGISTRO -->
                                            <!-- <span
                                                v-if="Number(item.headquarter_id) === Number(user.delegation_id) || Number(user.role_id) === 1">
                                                <span
                                                    v-if="permissions.delete_electrical_consumptions === 'delete_electrical_consumptions'"
                                                    @click="destroy(item); update = false" title="Eliminar"
                                                    class="text-danger cursor-pointer pl-2">
                                                    <i class="fas fa-trash fa-2x"></i>
                                                </span>
                                            </span> -->
                                            <!-- END -->

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler"
                            spinner="waveDots" ref="infiniteHandler">
                            <div slot="no-more">
                                No hay más registros de consumos eléctricos
                            </div>
                            <div slot="no-results">
                                No hay registros de consumos eléctricos
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
import LoaderComponent from '../../../components/LoaderComponent.vue';
import GenerateReportModalComponent from '../../../components/GenerateReportModalComponent.vue';
import MiMixin from '../../../components/mixin';

export default {
    components: {
        InfiniteLoading,
        VueEditor,
        vueDropzone: vue2Dropzone,
        LoaderComponent,
        GenerateReportModalComponent
    },
    name: "ElectricalConsumptions",
    mixins: [MiMixin],
    data() {
        return {
            id: null,
            FormElectricalConsumptions: {
                headquarter: null,
                year: null,
                month: null,
                kw_monthly: null,
                total_staff: null,
                observations: 'SIN OBSERVACIONES',
            },
            years: [],
            months: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
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
            delegations_export: [],
            municipalities_export: [],
            headquarters_export: [],
            delegations_model: null,
            municipalities_model: null,
            headquarters_model: null,
            users: [],
            yearFilter: '',
            monthFilter: '',
            update: false,
            user: null,
            evidences: [],
            electrical_consumption_id: null,

            // STAR VARIABLES PARA EL DROPZONE.JS
            csrfToken: null,
            dropzoneOptions: {
                url: '/g-environmental-rnec/electrical-consumptions/evidences/storeEvidence', // RUTA PARA ENVIAR AL CONTROLADOR
                thumbnailWidth: 200,
                addRemoveLinks: true,
                acceptedFiles: "image/*,.pdf", // RESTRINGE A DOCUMENTOS PDF
                headers: { 'X-CSRF-TOKEN': this.csrfToken }, // ENVIO DE TOKEN PARA LA PETICIÓM
                // EVENTO 'SENDING' PARA ENVIAR PARÁMETROS ADICIONALES
                sending: function (file, xhr, formData) {
                    formData.append("electrical_consumption_id", this.electrical_consumption_id); // AGREGAR EL VALOR DINÁMICO
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

        }
    },
    props: {
    },
    methods: {
        resetFormElectricalConsumptions() {
            this.$data["FormElectricalConsumptions"] = this.$options.data.call(this)["FormElectricalConsumptions"];
        },
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/electrical-consumptions/getElectricalConsumptions";
            axios.get(api, { params: { page: this.page, search: this.searchInput } })
                .then(({ data }) => {
                    if (data.electricalConsumptions.data.length > 0) {
                        this.page += 1;
                        this.list.push(...data.electricalConsumptions.data);
                        $state.loaded();
                    } else $state.complete();
                }).catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        queryFilter($state) {
            let api = "/g-environmental-rnec/electrical-consumptions/getElectricalConsumptions";
            axios.get(api, {
                params: {
                    search: this.searchInput,
                    delegations_model: this.delegations_model,
                    municipalities_model: this.municipalities_model,
                    headquarters_model: this.headquarters_model,
                    yearFilter: this.yearFilter,
                    monthFilter: this.monthFilter,
                }
            }).then(({ data }) => {
                // VACIO EL ARRAY PARA MOSTRAR LOS RESULTADOS DEL FILTRO
                for (let i = this.list.length; i > 0; i--) this.list.pop();

                // PINTO NUEVAMENTE LOS DATOS SEGÚN LOS FILTROS
                if (data.electricalConsumptions.data.length > 0) {
                    this.list.push(...data.electricalConsumptions.data);
                    $state.loaded();
                } else $state.complete();
            }).catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        createOrUpdate() {
            let url = this.update ? '/g-environmental-rnec/electrical-consumptions/' + this.id + '/update' : '/g-environmental-rnec/electrical-consumptions/store';
            axios.post(url, this.FormElectricalConsumptions)
                .then(response => {
                    this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                    if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.electricalConsumption.id)), 1);
                    this.list.unshift(response.data.electricalConsumption); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
                    this.resetFormElectricalConsumptions();
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
                    axios.delete('/g-environmental-rnec/electrical-consumptions/' + item.id + '/destroy')
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.list.splice(this.list.findIndex(element => (element.id === response.data.electricalConsumption.id)), 1);
                        }).catch(error => (error.response) ? this.responseErrors(error) : '');
                } else this.alertLoading(5000, "Se canceló con éxito", "info")
            });
        },
        createFuntions() {
            this.$emit('create-funtions');
        },
        evidenceElectricalConsumptions(item) {
            this.electrical_consumption_id = item.id;
            let api = "/g-environmental-rnec/electrical-consumptions/evidences/evidenceElectricalConsumption/" + item.id;
            axios.get(api)
                .then(({ data }) => this.evidences.push(...data.evidenceElectricalConsumptions))
                .catch(error => (error.response ? this.responseErrors(error) : ""));
        },
        storeEvidence() {
            this.$refs.myDropzone.processQueue();
        },
        handleSuccess(file, response) {
            this.alertLoading(response.timeout, response.msg, response.type)
            if (!response.new) this.evidences.splice(this.evidences.findIndex(element => (element.id === response.evidenceElectricalConsumption.id)), 1);
            this.evidences.unshift(response.evidenceElectricalConsumption); // UNSHIFT SIRVE PARA AGREGAR EL ELEMENTO AL ARRAY AL INICIO, PUSH LO AGREGA AL FINAL
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
            this.queryFilter();
        },
        clearDropzone() {
            this.evidences = [];
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
        },
        destroyEvidence(itemEvidence) {
            this.$swal({
                title: '¿Realmente desea eliminar esta adjunto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    axios.delete("/g-environmental-rnec/electrical-consumptions/evidences/" + itemEvidence.id + "/destroyEvidence")
                        .then(response => {
                            this.alertLoading(response.data.timeout, response.data.msg, response.data.type)
                            this.evidences.splice(this.evidences.findIndex(element => (element.id === response.data.evidenceElectricalConsumption.id)), 1);
                            this.queryFilter();
                        }).catch(this.response);
                } else this.alertLoading(5000, "Se canceló con éxito", "info")
            });
        },
        async writeData(data = {}) {
            this.id = data.id
            this.FormElectricalConsumptions.headquarter = {
                code: data.headquarter.id,
                label: data.headquarter.name,
            };
            this.FormElectricalConsumptions.year = data.year
            this.FormElectricalConsumptions.month = data.month
            this.FormElectricalConsumptions.kw_monthly = data.kw_monthly
            this.FormElectricalConsumptions.total_staff = data.total_staff
            this.FormElectricalConsumptions.observations = data.observations
        },
        validateFormElectricalConsumptions() {
            let disabled = Object.values(this.FormElectricalConsumptions).every(value => value !== null && value !== undefined && value !== "");
            return !disabled;
        },
    },
    created() {
        this.setAuthenticatedUser();
        this.setDelegations();
        this.setMunicipalities();
        this.setHeadquarters();
        this.setMunicipalitiesFilter();
        this.setHeadquartersFilter();
        this.setPermissions();
        this.getUsersInput();
        this.setCsrfToken();
        this.setYears();
        this.getCurrentYearConsumption();
        this.getCurrentDateWithSpanishMonth();
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
