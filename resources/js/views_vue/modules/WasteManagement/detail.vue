<template>
    <div v-if="permissions.length === 0">
        <loader-component></loader-component>
    </div>
    <div v-else-if="permissions.browse_waste_management === 'browse_waste_management' ||
        permissions.read_waste_management === 'read_waste_management'" class="card text-uppercase">
        <div class="card-header text-uppercase">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb m-0 p-0" style="border: none !important;">
                            <li class="breadcrumb-item active">
                                <router-link
                                    :to="{ name: 'waste-management-detail', params: { id: WasteManagementDetailList.id } }"
                                    @click="show = !show">
                                    <b>
                                        Detalle de la generación de residuos para:
                                        {{
                                            WasteManagementDetailList.headquarter ?
                                            WasteManagementDetailList.headquarter.delegation.name + " - " +
                                            WasteManagementDetailList.headquarter.municipality.city_name + " - " +
                                            WasteManagementDetailList.headquarter.name :
                                            'SIN SEDE'
                                        }}
                                        en
                                        {{ WasteManagementDetailList.month }}
                                        del
                                        {{
                                            WasteManagementDetailList.waste_type ?
                                            WasteManagementDetailList.waste_type.year :
                                            'AÑO NO DISPONIBLE'
                                        }}
                                    </b>
                                </router-link>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body" style="background: #d7d7d7 !important;">

            <!-- START EVIDENCIAS -->
            <div class="modal fade-scale" id="EvidencesWasteManagementModal" tabindex="-1" role="dialog"
                aria-labelledby="EvidencesWasteManagementModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #88b76e;">
                            <h5 class="modal-title text-uppercase text-white">
                                <b>EVIDENCIA(S)</b>
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
                                    <div v-if="hasImagesToShow" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                        <div id="carouselExampleControlsModal" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item" v-for="(itemImage, indexImage) in imagesToShow"
                                                    :key="indexImage" :class="{ active: indexImage === 0 }">
                                                    <img class="d-block w-100"
                                                        :src="'/storage/waste_management/evidences/files/' + itemImage.file">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControlsModal"
                                                role="button" data-slide="prev">
                                                <span v-if="imagesToShow.length > 1" class="carousel-control-prev-icon"
                                                    aria-hidden="true">
                                                    <i style="padding-top: 12px !important;"
                                                        class="fas fa-angle-double-left fa-2x text-white"></i>
                                                </span>
                                                <span class="sr-only">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControlsModal"
                                                role="button" data-slide="next">
                                                <span v-if="imagesToShow.length > 1" class="carousel-control-next-icon"
                                                    aria-hidden="true">
                                                    <i style="padding-top: 12px !important;"
                                                        class="fas fa-angle-double-right fa-2x text-white"></i>
                                                </span>
                                                <span class="sr-only">Siguiente</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div v-if="imagesToShow.length === 0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <div class="table-responsive">
                        <table id="sub_area-table"
                            class="table table-sm table-bordered table-striped table-condensed bg-white">
                            <thead class="bg-orange headerStatic">
                                <tr class="text-center">
                                    <th>TIPO DE RESIDUO</th>
                                    <th>CORRIENTE(S) DE PELIGROSIDAD</th>
                                    <th>VALOR (KG)</th>
                                    <th>ENCARGADO TRANSPORTE</th>
                                    <th>GESTOR EXTERNO</th>
                                    <th>LICENCIA AMBIENTAL</th>
                                    <th>CERTIFICADO / TIPO DE TRATAMIENTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-uppercase text-center">
                                        <span class="badge badge-info text-white w-100 full-16">
                                            {{ WasteManagementDetailList.waste_type.name ?
                                                WasteManagementDetailList.waste_type.name :
                                                'SIN TIPO DE RESIDUO'
                                            }}
                                        </span>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ WasteManagementDetailList.waste_type.danger_current ?
                                            WasteManagementDetailList.waste_type.danger_current :
                                            'SIN CORRIENTE(S) DE PELIGROSIDAD'
                                        }}
                                    </td>
                                    <td class="text-uppercase text-center">
                                        <b>{{ number_format(WasteManagementDetailList.value) }}</b>
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ WasteManagementDetailList.waste_type.transportation_manager ?
                                            WasteManagementDetailList.waste_type.transportation_manager :
                                            'SIN ENCARGADO TRANSPORTE'
                                        }}
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ WasteManagementDetailList.waste_type.external_manager ?
                                            WasteManagementDetailList.waste_type.external_manager :
                                            'SIN GESTOR EXTERNO'
                                        }}
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ WasteManagementDetailList.waste_type.environmental_license ?
                                            WasteManagementDetailList.waste_type.environmental_license :
                                            'SIN LICENCIA AMBIENTAL'
                                        }}
                                    </td>
                                    <td class="text-uppercase text-center">
                                        {{ WasteManagementDetailList.waste_type.certificate_or_type_of_treatment ?
                                            WasteManagementDetailList.waste_type.certificate_or_type_of_treatment :
                                            'SIN CERTIFICADO / TIPO DE TRATAMIENTO'
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-orange headerStatic text-center">
                                    <td colspan="7"><b>OBSERVACIONES</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" v-html="WasteManagementDetailList.observations"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div v-if="WasteManagementDetailList.evidence_waste_management.length > 0"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0">
                    <h5 class="mb-0">
                        <b>DOCUMENTOS ADJUNTOS</b>
                    </h5>
                </div>
                <template v-for="(item, index) in WasteManagementDetailList.evidence_waste_management">
                    <div :key="index" v-if="item.extension === 'pdf'" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <embed :src="'/storage/waste_management/evidences/files/' + item.file" type="application/pdf"
                            width="100%" height="600px" />
                    </div>
                </template>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div v-if="hasImagesToShow" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item" v-for="(itemImage, indexImage) in imagesToShow" :key="indexImage"
                                    :class="{ active: indexImage === 0 }">
                                    <img class="d-block w-100" data-toggle="modal"
                                        data-target="#EvidencesWasteManagementModal"
                                        style="height: 500px; max-height: 500px; cursor: pointer;"
                                        :src="'/storage/waste_management/evidences/files/' + itemImage.file">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span v-if="imagesToShow.length > 1" class="carousel-control-prev-icon" aria-hidden="true">
                                    <i style="padding-top: 12px !important;"
                                        class="fas fa-angle-double-left fa-2x text-white"></i>
                                </span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span v-if="imagesToShow.length > 1" class="carousel-control-next-icon" aria-hidden="true">
                                    <i style="padding-top: 12px !important;"
                                        class="fas fa-angle-double-right fa-2x text-white"></i>
                                </span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                    </div>
                    <div v-else class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5 class="mb-0">Sin imágenes relacionadas</h5>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr class="mt-0 mb-0">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTANTE</b></h5>
                            {{ WasteManagementDetailList.user.FullName }}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                            <h5><b>REPORTADO</b></h5>
                            {{ WasteManagementDetailList.user.CreatedLabel }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <v-btn color="#e55353" :to="{ name: 'waste-management-index' }" small class="btn btn-danger text-white"
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

export default {
    name: "WasteManagementDetail",
    data() {
        return {
            id: this.$route.params.id,
            WasteManagementDetailList: {},
            permissions: [],
        }
    },
    props: {
    },
    computed: {
        hasImagesToShow() {
            if (this.WasteManagementDetailList.evidence_waste_management)
                return this.imagesToShow.length > 0;
        },
        imagesToShow() {
            if (this.WasteManagementDetailList.evidence_waste_management)
                return this.WasteManagementDetailList.evidence_waste_management.filter(
                    item => item.extension !== 'pdf'
                );
            else return null;
        },
    },
    methods: {
        wasteManagementDetail() {
            let api = "/g-environmental-rnec/waste-management/show/" + this.id;
            axios.get(api)
                .then(({ data }) => this.WasteManagementDetailList = data.wasteManagement)
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
        this.wasteManagementDetail();
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
