<template>
    <div class="modal fade" id="GenerateReportModal" tabindex="-1" role="dialog" aria-labelledby="GenerateReportModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #88b76e">
                    <h5 class="modal-title text-uppercase text-white">
                        <b>{{ title }}</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <v-icon style="color: #fff">mdi-close</v-icon>
                        </span>
                    </button>
                </div>
                <div class="modal-body" style="background: #e7e7e7">
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
                            <h5 class="mb-0"><b>{{ title_2 }}</b></h5>
                        </div>
                        <div v-if="!other && !waste" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                            <div class="form-group mb-0">
                                <small class="text-danger"><b>(Desde) *</b></small>
                                <datepicker :language="es" v-model="FormReport.fromDay" :disabledDates="fromDay"
                                    :inputClass="inputClass" @change="validateFormReport" :format="customFormatter"
                                    :placeholder="fromPlaceholder">
                                </datepicker>
                            </div>
                        </div>
                        <div v-if="!other && !waste" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                            <div class="form-group mb-0">
                                <small class="text-danger"><b>(Hasta) *</b></small>
                                <datepicker :language="es" v-model="FormReport.untilDay" :disabledDates="untilDay"
                                    :inputClass="inputClass" @change="validateFormReport" :format="customFormatter"
                                    :placeholder="untilPlaceholder">
                                </datepicker>
                            </div>
                        </div>
                        <div v-if="other && !waste" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                            <div class="form-group mb-0">
                                <small><b class="text-danger">(Años) *</b></small>
                                <select class="form-control" name="year" id="year" v-model="FormReport.year">
                                    <option value="" selected disabled>AÑOS...</option>
                                    <option v-for="(item, index) in  years" :key="index">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div v-if="!other && waste" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                            <div class="form-group mb-0">
                                <small><b class="text-danger">(Años) *</b></small>
                                <select class="form-control" name="year" id="year" v-model="FormReport.year">
                                    <option value="" selected disabled>AÑOS...</option>
                                    <option v-for="(item, index) in  years" :key="index">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div v-if="other && !waste" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pb-0">
                            <div class="form-group mb-0">
                                <small><b>(Meses)</b></small>
                                <select class="form-control" name="month" id="month" v-model="FormReport.month">
                                    <option value="" selected disabled>MESES...</option>
                                    <option v-for="(item, index) in  months" :key="index">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                            <div class="form-group mb-0">
                                <small class="text-danger"><b>(Delegaciones) *</b></small>
                                <v-select :options="delegations_export" v-model="FormReport.delegation"
                                    @input="FormReport.municipality = null;
                                    FormReport.headquarter = null; municipalities = []; setMunicipalitiesFilterExport();" placeholder="Buscar...">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                            <div class="form-group mb-0">
                                <small class="text-danger"><b>(Municipios) *</b></small>
                                <v-select :options="municipalities_export" v-model="FormReport.municipality"
                                    @input="FormReport.headquarter = null; headquarters = []; setHeadquartersFilterExport();"
                                    placeholder="Buscar..." :disabled="FormReport.delegation === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pb-0">
                            <div class="form-group mb-0">
                                <small><b>(Sedes)</b></small>
                                <v-select :options="headquarters_export" v-model="FormReport.headquarter"
                                    placeholder="Buscar..." :disabled="FormReport.municipality === null ? true : false">
                                </v-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <v-btn color="#6c757d" title="Limpiar" small @click="cleanFormReport()"
                        class="btn btn-sm btn-grey text-white text-uppercase">
                        <b>LIMPIAR</b>
                    </v-btn>
                    <v-btn type="button" @click="generateReport('FormReport')" color="#2eb85c" small
                        class="btn btn-success text-uppercase text-white" data-dismiss="modal"
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
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";
import moment from "moment-timezone";

export default {
    components: {
        Datepicker,
    },
    name: "GenerateReportModalComponent",
    props: {
        permissions: {
            type: Object,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        title_2: {
            type: String,
            required: true,
        },
        url: {
            type: String,
            required: true,
            default: ""
        },
        fileName: {
            type: String,
            required: true,
            default: ""
        },
        other: {
            type: Boolean,
            required: true,
            default: false
        },
        waste: {
            type: Boolean,
            required: true,
            default: false
        },
        electrical: {
            type: Boolean,
            required: true,
            default: false
        },
        water: {
            type: Boolean,
            required: true,
            default: false
        },

    },
    data() {
        return {
            // START VARIABLES PARA GENERACIÓN DE REPORTES
            years: [],
            months: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
            delegations_export: [],
            municipalities_export: [],
            headquarters_export: [],
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
                year: '',
                month: '',
                delegation: null,
                municipality: null,
                headquarter: null,
            },
            file: false,
            // END VARIABLES PARA GENERACIÓN DE REPORTES
        }
    },
    methods: {
        setDelegationsFilterExport(search) {
            axios
                .get("/g-environmental-rnec/delegations/getDelegations", {
                    params: { search: search },
                })
                .then((res) => (this.delegations_export = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setMunicipalitiesFilterExport(search) {
            axios
                .get("/g-environmental-rnec/municipalities/getMunicipalities", {
                    params: {
                        search: search,
                        delegation: this.FormReport.delegation,
                        filter: true,
                    },
                })
                .then((res) => (this.municipalities_export = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setHeadquartersFilterExport(search) {
            axios
                .get(
                    "/g-environmental-rnec/headquarters/getHeadquartersFilter",
                    {
                        params: {
                            search: search,
                            municipality: this.FormReport.municipality,
                        },
                    }
                )
                .then((res) => (this.headquarters_export = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setAuthenticatedUserExport() {
            axios
                .post("/g-environmental-rnec/users/getAuthenticatedUser")
                .then((response) => {
                    this.FormReport.delegation = {
                        code: response.data.delegation.id,
                        label: response.data.delegation.name,
                    };
                    this.FormReport.municipality = {
                        code: response.data.municipality.id,
                        label: response.data.municipality.city_name,
                    };
                })
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setYears() {
            const currentDate = new Date();
            for (let index = 2022; index <= 2032; index++) this.years.push(index.toString())
            this.yearFilter = currentDate.getFullYear().toString();
            return this.years;
        },
        getCurrentYear() {
            const currentDate = new Date();
            if (this.other) // SI ES OTRO MÓDULO (CONSUMOS)
                if (!this.FormReport.year)
                    this.FormReport.year = currentDate.getFullYear().toString();
            this.yearFilter = currentDate.getFullYear().toString();
            return currentDate.getFullYear();
        },
        handleCreateFuntions() {
            this.setDelegationsFilterExport();
            this.setMunicipalitiesFilterExport();
            this.setHeadquartersFilterExport();
            this.setAuthenticatedUserExport();
            this.setYears();
            this.getCurrentYear();
        },
        validateFormReport() {
            if (!this.FormTreeReport) {
                let disabled = null;
                if (this.other) // SI ES OTRO MÓDULO (CONSUMOS)
                    disabled = Object.keys(this.FormReport).every(key => key === 'fromDay' || key === 'untilDay' || key === 'month' || key === 'headquarter' || (this.FormReport[key] !== null && this.FormReport[key] !== undefined && this.FormReport[key] !== ""));
                else if (this.waste) // SI ES GENERACIÓN DE RESIDUOS
                    disabled = Object.keys(this.FormReport).every(key => key === 'fromDay' || key === 'untilDay' || key === 'month' || key === 'headquarter' || (this.FormReport[key] !== null && this.FormReport[key] !== undefined && this.FormReport[key] !== ""));
                else disabled = Object.keys(this.FormReport).every(key => key === 'month' || key === 'year' || key === 'headquarter' || (this.FormReport[key] !== null && this.FormReport[key] !== undefined && this.FormReport[key] !== ""));
                return !disabled;
            }
        },
        customFormatter(date) {
            return moment(date).format("DD/MMMM/YYYY");
        },
        cleanFormReport() {
            if (!this.other) // SI ES OTRO MÓDULO (CONSUMOS)
            {
                this.FormReport.fromDay = null;
                this.FormReport.untilDay = null;
                this.defaultFuntions();
            }
        },
        defaultFuntions() {
            this.setAuthenticatedUserExport();
            this.setMunicipalitiesFilterExport();
            this.setHeadquartersFilterExport();
        },
        generateReport(type) {
            this.alertLoading(8000, "Generando reporte, por favor espere...", "info")
            let Form = null;
            switch (type) {
                case "FormReport":
                    Form = this.FormReport;
                    break;
            }
            if (Form !== null) {
                let headquarter = this.FormReport.headquarter
                axios.post(this.url, { ...Form, headquarter })
                    .then(this.responseReport)
                    .catch((error) => window.toastr.warning(error, { timeOut: 2000 }));
            }
            else this.alertLoading(10000, "No se aplicó ningún filtro", "error")
        },
        responseReport(response) {
            let fileName = this.fileName + response.data.fileName;
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
        alertLoading(time, msg, type) {
            this.$toastr.Add({
                timeout: time,
                type: type,
                msg: msg,
            });
        },
    },
    created() {
        this.$parent.$on('create-funtions', this.handleCreateFuntions);
    },
    beforeDestroy() {
        this.$parent.$off('create-funtions', this.handleCreateFuntions);
    },
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
