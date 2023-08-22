<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_audits === 'browse_audits' ||
        permissions.read_audits === 'read_audits' ||
        permissions.generate_report === 'generate_report'
        " class="card text-uppercase">
        <div class="card-header bg-espumados text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important">
                            <li class="breadcrumb-item active">
                                <a href="/v/admin/follow-up">
                                    <b>Seguimientos</b>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- AUDITS MODAL -->
        <div v-show="permissions.generate_report === 'generate_report'" class="modal fade" id="AuditsModal" tabindex="-1"
            role="dialog" aria-labelledby="AuditsModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #88b76e">
                        <h5 class="modal-title text-uppercase text-white">
                            <b>{{
                                report ? "Reporte de auditoría" : "SIN TÍTULO"
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
                                <h5 class="mb-0"><b>Fechas de acciones</b></h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <small class="text-danger"><b>(Desde)</b></small>
                                    <datepicker :language="es" v-model="FormReport.fromDay" :disabledDates="fromDay"
                                        :inputClass="inputClass" :format="customFormatter" :placeholder="fromPlaceholder">
                                    </datepicker>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <small class="text-danger"><b>(Hasta)</b></small>
                                    <datepicker :language="es" v-model="FormReport.untilDay" :disabledDates="untilDay"
                                        :inputClass="inputClass" :format="customFormatter" :placeholder="untilPlaceholder">
                                    </datepicker>
                                </div>
                            </div>
                        </div>
                        <!-- END -->
                    </div>
                    <div class="modal-footer">
                        <v-btn v-if="report" color="#39f" title="Hoy" small @click="generateReport('day')"
                            class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal">
                            <b>DIARIO</b>
                        </v-btn>
                        <v-btn v-if="report" color="#39f" title="Semanala" small @click="generateReport('week')"
                            class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal">
                            <b>SEMANAL</b>
                        </v-btn>
                        <v-btn v-if="report" color="#39f" title="Mensual" small @click="generateReport('month')"
                            class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal">
                            <b>MENSUAL</b>
                        </v-btn>
                        <v-btn v-if="report" color="#39f" title="Anual" small @click="generateReport('year')"
                            class="btn btn-sm btn-info text-white text-uppercase" data-dismiss="modal">
                            <b>ANUAL</b>
                        </v-btn>
                        <v-btn type="button" v-if="report" @click="generateReport('FormReport')" color="#2eb85c" small
                            class="btn btn-success text-uppercase text-white" data-dismiss="modal">
                            <b>Histórico / Rango</b>
                        </v-btn>
                        <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                            <b>CANCELAR</b>
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->
        <div class="card-body" style="background: #d7d7d7 !important">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-1 pt-0 responsive-case-custom"></div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 w-100 mb-1 pt-0">
                    <div class="input-group">
                        <input type="search" style="border-right: none !important" v-model="searchInput" id="search"
                            class="form-control" @change="changeType" placeholder="Buscar..." />
                        <span class="input-group-text border-search bg-info" title="Buscar" @click="$emit('Enter')">
                            <i class="fa-solid fa-search text-white"></i>
                        </span>
                        <span v-if="permissions.generate_report ===
                            'generate_report'
                            " class="input-group-text border-search bg-success" title="Generación de reportes"
                            data-toggle="modal" data-backdrop="static" data-target="#AuditsModal" @click="report = true">
                            <i class="fa-solid fa-file-excel text-white"></i>
                        </span>
                        <span class="input-group-text border-custom bg-dark" title="Refrescar" @click="clean">
                            <i class="fa-solid fa-rotate text-white"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div v-if="permissions.browse_audits === 'browse_audits' ||
                permissions.read_audits === 'read_audits'
                " class="table-responsive max-h-650">
                <table id="sub_area-table" class="table table-sm table-bordered table-striped table-condensed bg-white">
                    <thead class="bg-orange headerStatic">
                        <tr class="text-center">
                            <th class="tt-espumados">ACCIÓN</th>
                            <th class="tt-espumados">DESCRIPCIÓN</th>
                            <th class="tt-espumados">FECHA</th>
                            <th class="tt-espumados">MÓDULO</th>
                            <th class="tt-espumados">FUNCIONARI@</th>
                            <th class="tt-espumados">CARGO</th>
                            <th class="tt-espumados">DELEGACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in list" :key="index">
                            <td class="text-uppercase">{{ item.action }}</td>
                            <td class="text-center text-lowercase">
                                <span v-if="item.description" @click="commentAlert(item)" title="Descripción de la acción"
                                    class="text-info cursor-pointer">
                                    <i class="fas fa-comment-alt fa-2x"></i>
                                </span>
                            </td>
                            <td class="text-center" v-html="item.CreatedLabel"></td>
                            <td class="text-center text-uppercase">
                                {{ item.module }}
                            </td>
                            <td class="text-uppercase">
                                {{
                                    item.user
                                    ? item.user.id +
                                    " - " +
                                    item.user.first_name +
                                    " " +
                                    item.user.first_last_name
                                    : "SIN REGISTO"
                                }}
                            </td>
                            <td class="text-uppercase">
                                {{
                                    item.user
                                    ? item.user.position
                                    : "SIN REGISTO"
                                }}
                            </td>
                            <td class="text-uppercase">
                                {{
                                    item.user
                                    ? item.user.delegation
                                        ? item.user.delegation.name
                                        : "SIN DELEGACIÓN"
                                    : "SIN USUARIO"
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler" spinner="waveDots"
                    ref="infiniteHandler">
                    <div slot="no-more">No hay más auditorías</div>
                    <div slot="no-results">No hay auditorías</div>
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
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";

import moment from "moment-timezone";

export default {
    components: {
        InfiniteLoading,
        Datepicker,
    },
    name: "Audit",
    data() {
        return {
            id: "",
            role: "",
            report: false,
            page: 1,
            list: [],
            permissions: [],
            infiniteId: +new Date(),
            searchInput: "",
            setTimeoutSearch: "",
            errors: null,
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
                // FormReport, es el formulario que yo envío para la generación de un reporte
                fromDay: null,
                untilDay: null,
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
        };
    },
    methods: {
        infiniteHandler($state) {
            let api = "/g-environmental-rnec/audits/getAudits";
            axios
                .get(api, {
                    params: { page: this.page, search: this.searchInput },
                })
                .then(({ data }) => {
                    if (data.audits.data.length > 0) {
                        this.page += 1;
                        this.list.push(...data.audits.data);
                        $state.loaded();
                    } else $state.complete();
                })
                .catch((error) => (error.response ? this.response(error) : ""));
        },
        changeType() {
            this.page = 1;
            this.list = [];
            this.infiniteId += 1;
        },
        clean() {
            this.searchInput = null;
            this.changeType();
        },
        customFormatter(date) {
            return moment(date).format("DD/MMMM/YYYY");
        },
        commentAlert(item) {
            let jsonString = JSON.stringify(item, null, 2);
            this.$swal({
                customClass: {
                    popup: "my-custom-popup",
                },
                icon: "info",
                title: "Descripción general",
                html:
                    '<pre style="pre-custom"><code style="white-space: pre;">' +
                    jsonString +
                    "</code></pre>",
                showConfirmButton: true,
            });
        },
        commentAlert(item) {
            // Parse the 'description' string to a JavaScript object
            let descriptionObject = JSON.parse(item.description);

            // Stringify the 'description' object to a JSON string with proper formatting
            let jsonStringDescription = JSON.stringify(
                descriptionObject,
                null,
                2
            );

            // Replace the 'description' string with the formatted JSON string
            item.description = jsonStringDescription;

            // Stringify the 'item' object to a JSON string with proper formatting
            let jsonStringItem = JSON.stringify(item, null, 2);

            // Show the formatted JSON string in a SweetAlert2 alert
            this.$swal({
                icon: "info",
                title: "Descripción general",
                html:
                    '<pre class="pre-custom" style="text-align: left !important;"><code style="white-space: pre;">' +
                    jsonStringItem +
                    "</code></pre>",
                showConfirmButton: true,
            });
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
            const url = "/g-environmental-rnec/audits/generateReport";
            if (Form !== null)
                axios
                    .post(url, Form)
                    .then(this.responseReport)
                    .catch((error) =>
                        window.toastr.warning(error, { timeOut: 2000 })
                    );
            else
                window.toastr.error("No se aplicó ningún filtro", {
                    timeOut: 5000,
                });
        },
        responseReport(response) {
            let fileName = "/storage/reports/audits/" + response.data.fileName;
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
        response(error) {
            console.log(error.response);
            if (error.response.status === 500) {
                this.$swal({
                    icon: error.response.data.icon
                        ? error.response.data.icon
                        : "warning",
                    title: "Oops!",
                    html:
                        '<p class="text-justify"><b class="text-danger">Error:</b> ' +
                        error.response.data.message +
                        "</p>",
                    showConfirmButton: false,
                });
            }
        },
        getPermissions() {
            axios
                .post("/g-environmental-rnec/home/permissions")
                .then((response) => (this.permissions = response.data))
                .catch((errors) => console.log(errors));
        },
    },
    created() {
        this.getPermissions();
    },
};
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
    background: #ffffff !important;
    color: #000 !important;
    border-radius: 4px !important;
    border: 1px solid !important;
}
</style>
