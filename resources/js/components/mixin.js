// miMixin.js
import axios from "axios";
import moment from "moment-timezone";

export default {
    methods: {
        setAuthenticatedUser() {
            axios
                .post("/g-environmental-rnec/users/getAuthenticatedUser")
                .then((response) => {
                    this.user = response.data;
                    this.delegations_model = {
                        code: response.data.delegation.id,
                        label: response.data.delegation.name,
                    };
                    this.municipalities_model = {
                        code: response.data.municipality.id,
                        label: response.data.municipality.city_name,
                    };
                    this.FormReport.delegation = {
                        code: response.data.delegation.id,
                        label: response.data.delegation.name,
                    };
                    this.FormReport.municipality = {
                        code: response.data.municipality.id,
                        label: response.data.municipality.city_name,
                    };
                    this.FormReport.headquarter = {
                        code: response.data.headquarter.id,
                        label: response.data.headquarter.name,
                    };
                })
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setPermissions() {
            axios
                .post("/g-environmental-rnec/home/permissions")
                .then((response) => (this.permissions = response.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setDelegations(search) {
            axios
                .get("/g-environmental-rnec/delegations/getDelegations", {
                    params: { search: search },
                })
                .then((res) => (this.delegations = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setMunicipalities(search) {
            axios
                .get("/g-environmental-rnec/municipalities/getMunicipalities", {
                    params: { search: search },
                })
                .then((res) => (this.municipalities = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setMunicipalitiesFilter(search) {
            axios
                .get("/g-environmental-rnec/municipalities/getMunicipalities", {
                    params: {
                        search: search,
                        delegation: this.delegations_model,
                        filter: true,
                    },
                })
                .then((res) => (this.municipalities = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setHeadquarters(search) {
            axios
                .get("/g-environmental-rnec/headquarters/getHeadquarters", {
                    params: { search: search },
                })
                .then((res) => (this.headquarters = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setHeadquartersFilter(search) {
            axios
                .get(
                    "/g-environmental-rnec/headquarters/getHeadquartersFilter",
                    {
                        params: {
                            search: search,
                            municipality: this.municipalities_model,
                        },
                    }
                )
                .then((res) => (this.headquarters = res.data.data))
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setCsrfToken() {
            axios
                .get("/g-environmental-rnec/csrf-token")
                .then(
                    (response) =>
                        (this.dropzoneOptions.headers["X-CSRF-TOKEN"] =
                            response.data)
                )
                .catch((error) =>
                    error.response ? this.responseErrors(error) : ""
                );
        },
        setYears() {
            const currentDate = new Date();
            for (let index = 2022; index <= 2032; index++)
                this.years.push(index.toString());
            this.yearFilter = currentDate.getFullYear().toString();
            return this.years;
        },
        getSpanishMonthName(month) {
            const spanishMonthNames = [
                "ENERO",
                "FEBRERO",
                "MARZO",
                "ABRIL",
                "MAYO",
                "JUNIO",
                "JULIO",
                "AGOSTO",
                "SEPTIEMBRE",
                "OCTUBRE",
                "NOVIEMBRE",
                "DICIEMBRE",
            ];
            return spanishMonthNames[month];
        },
        getCurrentDateWithSpanishMonth() {
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth();
            const monthName = this.getSpanishMonthName(currentMonth);
            if (!this.FormElectricalConsumptions.month)
                this.FormElectricalConsumptions.month =
                    this.getSpanishMonthName(currentMonth).toString();
            if (!this.FormElectricalConsumptions.month)
                this.FormElectricalConsumptions.month =
                    this.getSpanishMonthName(currentMonth).toString();
            return monthName;
        },
        getCurrentYear() {
            const currentDate = new Date();
            return currentDate.getFullYear();
        },
        getCurrentYearConsumption() {
            const currentDate = new Date();
            if (!this.FormElectricalConsumptions.year)
                this.FormElectricalConsumptions.year = currentDate
                    .getFullYear()
                    .toString();
            // if (!this.FormWaterConsumptions.year)
            //     this.FormWaterConsumptions.year = currentDate
            //         .getFullYear()
            //         .toString();
            return currentDate.getFullYear();
        },
        getUsersInput() {
            axios
                .post("/g-environmental-rnec/users/getUsersInput")
                .then((response) => (this.users = response.data.data))
                .catch((errors) => console.log(errors));
        },
        changeType() {
            this.page = 1;
            this.list = [];
            this.infiniteId += 1;
        },
        clean() {
            const currentDate = new Date();
            this.searchInput = null;
            this.dateFilter = null;
            this.stateFilter = "";
            this.delegations_model = null;
            this.municipalities_model = null;
            this.headquarters_model = null;
            this.yearFilter = currentDate.getFullYear().toString();
            this.monthFilter = "";
            this.changeType();
            this.defaultFuntions();
        },
        cleanFormReport() {
            this.FormReport.fromDay = null;
            this.FormReport.untilDay = null;
            this.defaultFuntions();
        },
        defaultFuntions() {
            this.setAuthenticatedUser();
            this.setMunicipalitiesFilter();
            this.setHeadquartersFilter();
        },
        customFormatter(date) {
            return moment(date).format("DD/MMMM/YYYY");
        },
        clearDropzone() {
            this.evidences = [];
            this.$refs.myDropzone.removeAllFiles(); // LIMPIA EL CONTENIDO DEL DROPZONE
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
        customFormatter(date) {
            return moment(date).format("DD/MMMM/YYYY");
        },
        number_format(amonth, decimals) {
            amonth += ""; // POR SI PASAN UN NUMERO EN VEZ DE UN STRING
            amonth = parseFloat(amonth.replace(/[^0-9\.]/g, "")); // ELIMINO CUALQUIER COSA QUE NO SEA NUMERO O PUNTO
            decimals = decimals || 0; // POR SI LA VARIABLE NO FUE FUE PASADA
            // SI NO ES UN NUMERO O ES IGUAL A CERO RETORNO EL MISMO CERO
            if (isNaN(amonth) || amonth === 0)
                return parseFloat(0).toFixed(decimals);
            // SI ES MAYOR O MENOR QUE CERO RETORNO EL VALOR FORMATEADO COMO NUMERO
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
        // AGREGA ESTA FUNCIÓN PARA ABRIR EL MODAL Y ESTABLECER MODALVISIBLE EN VERDADERO
        openModal() {
            this.modalMapVisible = true;
            // FORZAR UNA ACTUALIZACIÓN DEL MAPA DESPUÉS DE 100 MILISEGUNDOS
            // ESTO LE DA TIEMPO AL MODAL PARA TENER SU TAMAÑO CORRECTAMENTE DEFINIDO.
            setTimeout(() => {
                this.$refs.mapRef.invalidateSize();
            }, 5000);
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
                let msg = "";

                // RECORRE TODOS LOS ERRORES Y LOS ADJUNTA EN UNA VARIABLE
                Object.values(error.response.data.errors).map(
                    (errors, index) =>
                        (msg += `<li style="margin-bottom: 10px !important;"><b>${
                            index + 1
                        }.</b> ${errors[0]}</li>`)
                );

                // ALERTA QUE MUESTRA AL USUARIO FINAL LOS ERRORES
                this.$swal({
                    icon: "error", // ICONO
                    title: "¡Hola! te invitamos a que revises tús campos", // TÍTULO DE LA NOTIFICACIÓN
                    html: `<ul class="text-danger text-left">${msg}</ul>`, // CONTENIDO DE LA NOTIFICACIÓN
                    showConfirmButton: true, // BOTON DE CONFIRMACIÓN PARA CERRAR LA VENTANA
                    timer: 15000, // 15 SEG PARA QUE EL USUARIO LEA
                    timerProgressBar: true, // PERMITE LA VISUALIZACIÓN DE UNA BARRA QUE VA INDICNDO CUANDO TIEMPO FALTA PARA QUE LA VENTANA DSE CIERRE
                });
            }

            if (error.response.status === 500) {
                this.$swal({
                    icon: "warning", // ICONO
                    title: "Oops!", // TÍTULO DE LA NOTIFICACIÓN
                    html:
                        "<p>Ocurrio un error con el servidor...</p>" +
                        '<p class="text-justify"><b class="text-warning">ADVERTENCIA:</b> ' +
                        error.response.data.msg +
                        "</p>", // CONTENIDO DE LA NOTIFICACIÓN
                    showConfirmButton: true, // BOTON DE CONFIRMACIÓN PARA CERRAR LA VENTANA
                    timer: 15000, // 15 SEG PARA QUE EL USUARIO LEA
                    timerProgressBar: true, // PERMITE LA VISUALIZACIÓN DE UNA BARRA QUE VA INDICNDO CUANDO TIEMPO FALTA PARA QUE LA VENTANA DSE CIERRE
                });
            }
        },
    },
};
