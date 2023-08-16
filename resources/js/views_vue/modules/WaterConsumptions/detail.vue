<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_tree_plantations === 'browse_tree_plantations' ||
        permissions.read_tree_plantations === 'read_tree_plantations'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link
                                    :to="{ name: 'tree-plantations-detail', params: { id: CoResponsibilityAgreementDetailList.id } }"
                                    @click="show = !show">
                                    <b>
                                        Detalle del acuerdo de corresponsabilidad para
                                        {{ CoResponsibilityAgreementDetailList.delegation.name }}
                                    </b>
                                </router-link>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active w-100" v-html="CoResponsibilityAgreementDetailList.StateLabel"></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-2">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important; float: right !important;">
                            <li class="breadcrumb-item active">
                                <b>
                                    Hecha el:
                                    {{ CoResponsibilityAgreementDetailList.DateLabel }}
                                </b>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body" style="background: #d7d7d7 !important;">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h5><b>MUNICIPIOS A LOS CUALES LES APLICA</b></h5>
                    <div>
                        <ul class="list-custom"
                            v-for="(item, index) in  CoResponsibilityAgreementDetailList.municipalities " :key="index">
                            <li class="list-custom">{{ item.FullCityName }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h5><b>GESTOR(ES) AMBIENTAL(ES)</b></h5>
                    <div>
                        <ul class="list-custom" v-for="(item, index) in  CoResponsibilityAgreementDetailList.users "
                            :key="index">
                            <li class="list-custom">{{ item.FullName }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group mb-0">
                        <h5><b>OPERADOR AMBIENTAL (ASOCIACIÓN DE RECICLADORES / EMPRESA / GESTOR AUTORIZADO)</b></h5>
                        {{ CoResponsibilityAgreementDetailList.environmental_operator }}
                    </div>
                </div>
                <div v-if="CoResponsibilityAgreementDetailList.evidence_co_responsibility_agreement.length > 0"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                    <h5 class="mb-0">
                        <b>DOCUMENTOS ADJUNTOS</b>
                    </h5>
                </div>
                <div v-for="(item, index) in CoResponsibilityAgreementDetailList.evidence_co_responsibility_agreement"
                    :key="index" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <embed :src="'/storage/co_responsibility_agreements/evidences/documents/' + item.file"
                        type="application/pdf" width="100%" height="600px" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                            <h5 class="mb-0"><b>OBSERVACIONES Y CAMBIOS</b></h5>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                            v-html="CoResponsibilityAgreementDetailList.observations">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr class="mt-0 mb-0">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTANTE</b></h5>
                            {{ CoResponsibilityAgreementDetailList.user.FullName }}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTADO</b></h5>
                            {{ CoResponsibilityAgreementDetailList.user.CreatedLabel }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <v-btn color="#e55353" :to="{ name: 'co-responsibility-agreements-index' }" small
                class="btn btn-danger text-white" data-dismiss="modal">
                <b>VOLVER</b>
            </v-btn>
        </div>
    </div>
    <div v-else>
        <forbidden-component></forbidden-component>
    </div>
</template>

<script>
import { latLng } from "leaflet";

export default {
    name: "coResponsibilityAgreementDetail",
    data() {
        return {
            id: this.$route.params.id,
            CoResponsibilityAgreementDetailList: {},
            permissions: [],
        }
    },
    props: {
    },
    methods: {
        coResponsibilityAgreementDetail() {
            let api = "/g-environmental-rnec/co-responsibility-agreements/show/" + this.id;
            axios.get(api)
                .then(({ data }) => this.CoResponsibilityAgreementDetailList = data.coResponsibilityAgreement)
                .catch(error => (error.response ? this.responseErrors(error) : ""));
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
        number_format(amonth, decimals) {
            amonth += ""; // por si pasan un numero en vez de un string
            amonth = parseFloat(amonth.replace(/[^0-9\.]/g, "")); // elimino cualquier cosa que no sea numero o punto
            decimals = decimals || 0; // por si la variable no fue fue pasada
            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amonth) || amonth === 0)
                return parseFloat(0).toFixed(decimals);
            // si es mayor o menor que cero retorno el valor formateado como numero
            amonth = "" + amonth.toFixed(decimals);
            var amonth_parts = amonth.split("."),
                regexp = /(\d+)(\d{3})/;
            while (regexp.test(amonth_parts[0]))
                while (regexp.test(amonth_parts[0]))
                    amonth_parts[0] = amonth_parts[0].replace(
                        regexp,
                        "$1" + "," + "$2"
                    );
            return amonth_parts.join(".");
        },
        setPermissions() {
            axios.post("/g-environmental-rnec/home/permissions")
                .then(response => this.permissions = response.data)
                .catch(errors => console.log(errors));
        },
    },
    created() {
        this.coResponsibilityAgreementDetail();
        this.setPermissions();
    }
}
</script>



<style scoped>
:root {
    --color1: #5271C2;
}

.card .card__num__main {
    text-shadow: longshadow(darken(var(--color1), 15%), var(--color1), 100, 0.8);
}

.card__front__main {
    transform: rotateY(0);
    z-index: 2;
    overflow: hidden;
}

.card__name__main {
    font-size: 32px;
    line-height: 0.9;
    font-weight: 700;
    margin-top: 20px;
}

.card__name__main span {
    font-size: 14px;
}

.card__num__main {
    font-size: 100px;
    margin: 0;
    font-weight: 700;
    margin-top: -20px;

    @media (max-width: 700px) {
        font-size: 70px;
    }
}

@media (max-width: 700px) {

    .card__front__main {
        height: 230px;
    }
}

/* Demo */
main {
    text-align: center;
}

main h1,
main p {
    margin: 0 0 12px 0;
}

main h1 {
    margin-top: 12px;
    font-weight: 300;
}

.fa-twitter {
    color: white;
    font-size: 30px;
}

.bg-green-custom {
    color: white !important;
    background: #88B788 !important;
}

.mg-12 {
    margin: 12px;
}

.hr-separator {
    height: 2px;
    background: #88B788 !important;
}

ul.list-custom {
    list-style-type: none;
    margin: 0;
}

ul.list-custom li.list-custom {
    position: relative;
    font-weight: bold;
    font-size: 20px;
    line-height: 30px;
    padding: 10px 0 10px 50px;
    margin-bottom: 10px;
    background: #f5f5f5;
}

ul.list-custom li.list-custom:before {
    content: "\2022";
    position: absolute;
    left: 0;
    top: 0;
    font-weight: bold;
    font-size: 40px;
    padding: 5px 8px 8px 8px;
    background: #88B788;
    color: white;
    height: 50px;
}
</style>
