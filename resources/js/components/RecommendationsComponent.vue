<template>
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
                    Para una óptima visualización, le recomendamos cargar las evidencias
                    fotográficas en formato horizontal.
                </strong>
            </li>
            <li class="list-general pb-3">
                <strong>
                    Asegúrese de que las imágenes estén en formato:
                    <b class="text-danger">.JPG, .JPEG o .PNG</b>
                    <span v-if="!tree_plantation">
                        y los documentos en: <b class="text-danger">.PDF</b>
                    </span>.
                </strong>
            </li>
            <li class="list-general">
                <strong>
                    Por último, podrá cargar un máximo de 2 archivos simultáneamente.
                </strong>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "RecommendationsComponent",
    props: {
        tree_plantation: {
            type: Boolean,
            required: true,
            default: false
        },

    },
}
</script>

<style scoped></style>
