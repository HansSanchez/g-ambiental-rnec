<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_tree_plantations === 'browse_tree_plantations' ||
        permissions.read_tree_plantations === 'read_tree_plantations'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link
                                    :to="{ name: 'tree-plantations-detail', params: { id: TreePlantationDetailList.id } }"
                                    @click="show = !show">
                                    <b>
                                        Detalle de la plantación de árboles en
                                        {{ TreePlantationDetailList.address }}
                                    </b>
                                </router-link>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important; float: right !important;">
                            <li class="breadcrumb-item active">
                                <b>
                                    Hecha el:
                                    {{ TreePlantationDetailList.DateLabel }}
                                </b>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body" style="background: #d7d7d7 !important;">

            <!-- START EVIDENCIAS -->
            <div class="modal fade-scale" id="EvidencesTreePlantationModal" tabindex="-1" role="dialog"
                aria-labelledby="EvidencesTreePlantationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #88b76e;">
                            <h5 class="modal-title text-uppercase text-white">
                                <b>EVIDENCIAS DE LA PLANTACIÓN EN {{ TreePlantationDetailList.address }}</b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <v-icon style="color: #fff;">mdi-close</v-icon>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body bv-modal">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div v-if="TreePlantationDetailList.evidence_tree_plantations.length > 0"
                                        class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item"
                                                    v-for="(itemImage, indexImage) in TreePlantationDetailList.evidence_tree_plantations"
                                                    :key="indexImage" :class="{ active: indexImage === 0 }">
                                                    <img class="d-block w-100"
                                                        :src="'/storage/tree_plantations/evidences/images/' + itemImage.file">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                                data-slide="prev">
                                                <span v-if="TreePlantationDetailList.evidence_tree_plantations.length > 1"
                                                    class="carousel-control-prev-icon" aria-hidden="true">
                                                    <i style="padding-top: 12px !important;"
                                                        class="fas fa-angle-double-left fa-2x text-white"></i>
                                                </span>
                                                <span class="sr-only">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                                data-slide="next">
                                                <span v-if="TreePlantationDetailList.evidence_tree_plantations.length > 1"
                                                    class="carousel-control-next-icon" aria-hidden="true">
                                                    <i style="padding-top: 12px !important;"
                                                        class="fas fa-angle-double-right fa-2x text-white"></i>
                                                </span>
                                                <span class="sr-only">Siguiente</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div v-if="TreePlantationDetailList.evidence_tree_plantations.length == 0"
                                        class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="mb-0">Sin imágenes relacionadas</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <v-btn color="#e55353" small class="btn btn-danger text-white" data-dismiss="modal">
                                <b>CANCELAR</b>
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EVIDENCIAS -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5><b>COORDENADAS <span class="text-danger">*</span></b></h5>
                            <l-map style="height: 30vh" :zoom="zoom" :center="center">
                                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                                <!-- MARCADORES EXISTENTES EN EL ARRAY MAPMARKERS -->
                                <l-marker :lat-lng="[parseFloat(lat), parseFloat(lng)]" :icon="getIcon()">
                                </l-marker>
                            </l-map>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group mb-0">
                                        <h5><b>LATITUD</b></h5>
                                        <input v-model="TreePlantationDetailList.lat" type="text" name="lat" id="lat"
                                            class="form-control" placeholder="Coordenada de latitud" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group mb-0">
                                        <h5><b>LONGITUD</b></h5>
                                        <input v-model="TreePlantationDetailList.lng" type="text" name="lng" id="lng"
                                            class="form-control" placeholder="Coordenada de longitud" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 full-center">
                            <div class="bg-green-custom w-100">
                                <div class="card__front__main">
                                    <p class="card__name__main mb-0">
                                        Árboles
                                        <br>
                                        Plantados
                                        <br>
                                        Delegación: {{ TreePlantationDetailList.delegation.name }}
                                    </p>
                                    <p class="card__num__main mb-0">
                                        <i class="fa-solid fa-tree" style="color: #ffffff;"></i>
                                        {{ TreePlantationDetailList.number_of_trees_planted }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div v-if="TreePlantationDetailList.evidence_tree_plantations.length > 0"
                                class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item"
                                            v-for="(itemImage, indexImage) in TreePlantationDetailList.evidence_tree_plantations"
                                            :key="indexImage" :class="{ active: indexImage === 0 }">
                                            <img class="d-block w-100" data-toggle="modal"
                                                data-target="#EvidencesTreePlantationModal"
                                                style="height: 236px import; max-height: 236px !important; cursor: pointer;"
                                                :src="'/storage/tree_plantations/evidences/images/' + itemImage.file">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                        data-slide="prev">
                                        <span v-if="TreePlantationDetailList.evidence_tree_plantations.length > 1"
                                            class="carousel-control-prev-icon" aria-hidden="true">
                                            <i style="padding-top: 12px !important;"
                                                class="fas fa-angle-double-left fa-2x text-white"></i>
                                        </span>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                        data-slide="next">
                                        <span v-if="TreePlantationDetailList.evidence_tree_plantations.length > 1"
                                            class="carousel-control-next-icon" aria-hidden="true">
                                            <i style="padding-top: 12px !important;"
                                                class="fas fa-angle-double-right fa-2x text-white"></i>
                                        </span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>
                                </div>
                            </div>
                            <div v-if="TreePlantationDetailList.evidence_tree_plantations.length == 0"
                                class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 class="mb-0">Sin imágenes relacionadas</h5>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                            <h5 class="mb-0"><b>OBSERVACIONES (ESPECIES PLANTADAS)</b></h5>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" v-html="TreePlantationDetailList.observations">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr class="mt-0 mb-0">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTANTE</b></h5>
                            {{ TreePlantationDetailList.user.FullName }}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTADO</b></h5>
                            {{ TreePlantationDetailList.user.CreatedLabel }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <v-btn color="#e55353" :to="{ name: 'tree-plantations-index' }" small class="btn btn-danger text-white"
                data-dismiss="modal">
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
    name: "TreePlantationDetail",
    data() {
        return {
            id: this.$route.params.id,
            TreePlantationDetailList: {},
            permissions: [],

            // START VARIABLES PARA EL MAPA
            zoom: 12,
            lat: 0,
            lng: 0,
            center: latLng(4.570868, -74.297333),
            url: "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            mapOptions: {
                zoomSnap: 1,
            },
            // END VARIABLES PARA EL MAPA
        }
    },
    props: {
    },
    methods: {
        TreePlantationDetail() {
            let api = "/g-environmental-rnec/tree-plantations/show/" + this.id;
            axios.get(api)
                .then(({ data }) => {
                    this.TreePlantationDetailList = data.treePlantation;
                    this.lat = parseFloat(data.treePlantation.lat);
                    this.lng = parseFloat(data.treePlantation.lng);
                    this.center = latLng(parseFloat(data.treePlantation.lat), parseFloat(data.treePlantation.lng));
                })
                .catch(error => (error.response ? this.responseErrors(error) : ""));
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
        this.TreePlantationDetail();
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
</style>
