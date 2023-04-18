<template>
    <v-card
        color="light-blue-darken-1"
        flat
        rounded="0"
        elevation="6"
    >
        <v-toolbar extended color="light-blue-darken-1">
            <v-app-bar-nav-icon></v-app-bar-nav-icon>

            <v-toolbar-title class="text-h5">{{user.email}}</v-toolbar-title>

            <v-spacer></v-spacer>


        </v-toolbar>
    </v-card>
        <v-container fluid>
            <v-row justify="end" class="md-4 xs-3">
                <v-col cols="4" class="lg-5">
                    <Link href="/academicos/crear-deteccion" as="button" type="button">
                        <v-btn prepend-icon="mdi-file-document-plus-outline" block size="x-large" type="button"
                               color="light-blue-lighten-4">
                            Capturar Deteccion de Necesidades
                        </v-btn>
                    </Link>
                </v-col>
            </v-row>
        </v-container>
        <v-container class="pt-4 mt-4">
            <v-row justify="center">
                <v-card elevation="8">
                    <v-table
                        fixed-header
                        height="300px"
                        hover
                    >
                        <thead>
                        <tr>
                            <th class="text-left">
                                Dirigido
                            </th>
                            <th class="text-left">
                                Nombre del curso
                            </th>
                            <th class="text-left">
                                Contenido tematicos
                            </th>
                            <th class="text-left">
                                Periodo de Realización
                            </th>
                            <th class="text-left">
                                Objetivo de la actividad o evento
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="deteccion in detecciones" @click="getRow(deteccion)"
                            :key="deteccion.id" :class="{ itemSelected: deteccion === itemSelected }"

                        >
                            <td class="v-card--hover">{{deteccion.nameCarrera}}</td>
                            <td class="v-card--hover">{{deteccion.nombreCurso}}</td>
                            <td class="v-card--hover">{{deteccion.contenidosTM}}</td>
                            <template v-if="deteccion.periodo === 1">
                                <td class="v-card--hover">ENERO-JUNIO</td>
                            </template>
                            <template v-if="deteccion.periodo === 2">
                                <td class="v-card--hover">AGOSTO-DICIEMBRE</td>
                            </template>
                            <td class="v-card--hover">{{deteccion.objetivoEvento}}</td>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card>
            </v-row>
        </v-container>


        <v-container class="pt-4 mt-4">
            <v-row justify="center">
                <v-card elevation="8">
                    <v-table
                        fixed-header
                        height="300px"
                        hover
                    >
                        <thead>
                        <tr>
                            <th class="text-left">
                                Dirigido
                            </th>
                            <th class="text-left">
                                Nombre del curso
                            </th>
                            <th class="text-left">
                                Contenido tematicos
                            </th>
                            <th class="text-left">
                                Periodo de Realización
                            </th>
                            <th class="text-left">
                                Objetivo de la actividad o evento
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="deteccionsi in deteccionesSI"
                            :key="deteccionsi.id"

                        >
                            <td class="v-card--hover">{{deteccionsi.nameCarrera}}</td>
                            <td class="v-card--hover">{{deteccionsi.nombreCurso}}</td>
                            <td class="v-card--hover">{{deteccionsi.contenidosTM}}</td>
                            <template v-if="deteccionsi.periodo === 1">
                                <td class="v-card--hover">ENERO-JUNIO</td>
                            </template>
                            <template v-if="deteccionsi.periodo === 2">
                                <td class="v-card--hover">AGOSTO-DICIEMBRE</td>
                            </template>
                            <td class="v-card--hover">{{deteccionsi.objetivoEvento}}</td>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card>
            </v-row>
        </v-container>

        <v-dialog v-model="dialog" fullscreen
                  :scrim="false"
                  transition="dialog-bottom-transition">
            <v-card>
                <v-toolbar
                    dark
                    color="blue-lighten-1"

                >
                    <v-btn
                        icon
                        dark
                        @click="dialog = false"
                        size="x-large"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>

                    <Link :href="'/academicos/edit-deteccion' + '/' + itemSelected.id" as="button" type="button">
                        <v-btn type="button" prepend-icon="mdi-file-edit-outline" size="x-large">
                            Editar
                        </v-btn>
                    </Link>

                </v-toolbar>
                <v-container class="mx-auto">
                    <v-row justify="center">
                        <v-sheet :height="250" :width="3000">
                            <v-card-title class="text-center text-h5">
                                {{itemSelected.nombreCurso}}
                            </v-card-title>
                            <v-spacer></v-spacer>
                            <v-card-text>
                                <v-container class="pt-4 mt-4">
                                    <v-row align="center" justify="center">
                                        <v-col cols="12">
                                            <h4>Asignaturas en la que se requiere formación o actualización.</h4>
                                            <v-card class="text-center" elevation="0">{{itemSelected.asignaturaFA}}</v-card>
                                        </v-col>
                                        <v-col cols="12">
                                            <h4>Contenidos temáticos en que se requiere la formación o actualización.</h4>
                                            <v-card class="text-center" elevation="0">{{itemSelected.contenidosTM}}</v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Número de profesores(as) que la requieren.</h4>
                                            <v-card class="text-center text-h6" elevation="0">{{itemSelected.numeroProfesores}}</v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Periodo en el que se requiere la formación o actualización (enero-junio o agosto diciembre)</h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                <template v-if="itemSelected.periodo === 1">
                                                    ENERO-JUNIO
                                                </template>
                                                <template v-if="itemSelected.periodo === 2  ">
                                                    AGOSTO-DICIEMBRE
                                                </template>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Asignaturas en la que se requiere formación o actualización.</h4>
                                            <v-card class="text-center text-h6" elevation="0">{{itemSelected.nameCarrera}}</v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Facilitador(es)</h4>
                                            <v-card class="text-center text-h6" elevation="0">{{itemSelected.deteccion_facilitador[0].nombre_completo}}</v-card>
                                        </v-col>
                                    </v-row>
                                    <v-row justify="center" class="mt-2">
                                        <v-col cols="6">
                                            <h4>Nombre del curso, taller, conferencias, etc.</h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                <template v-if="itemSelected.periodo === 1">
                                                    TALLER
                                                </template>
                                                <template v-if="itemSelected.periodo === 2">
                                                    CURSO
                                                </template>
                                                <template v-if="itemSelected.periodo === 3">
                                                    CURSO-TALLER
                                                </template>
                                                <template v-if="itemSelected.periodo === 4">
                                                    FORO
                                                </template>
                                                <template v-if="itemSelected.periodo === 5">
                                                    SEMINARIO
                                                </template>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Tipo de solicitud</h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                <template v-if="itemSelected.periodo === 1">
                                                    FORMACIÓN DOCENTE
                                                </template>
                                                <template v-if="itemSelected.periodo === 2">
                                                    ACTUALIZACIÓN PROFESIONAL
                                                </template>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Fecha en que se realizará la actividad o evento: </h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                {{dateFormat}}
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Fecha en que concluira la actividad o evento: </h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                {{formatDate}}
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Hora de inicio: </h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                {{itemSelected.hora_I}}
                                            </v-card>
                                        </v-col>
                                        <v-col cols="6">
                                            <h4>Hora de finalización: </h4>
                                            <v-card class="text-center text-h6" elevation="0">
                                                {{itemSelected.hora_F}}
                                            </v-card>
                                        </v-col>

                                        <v-col cols="12" class="mt-4">
                                            <h4>Objetivo de la actividad o evento.</h4>
                                            <v-card class="text-h6" elevation="0">
                                                {{itemSelected.objetivoEvento}}
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                        </v-sheet>
                    </v-row>
                </v-container>
            </v-card>
        </v-dialog>

</template>

<script setup>
import AcademicosMain from "../Navigation/AcademicosMain.vue";
import {computed, onMounted, ref} from "vue";
import {Link, router, usePage} from "@inertiajs/vue3";
// props
defineProps({
    carer: Array
})
// Variables
const dialog = ref(false);
let itemSelected = ref({});
const period = ref([
    {text: "ENERO-JUNIO", value: 1},
    {text: "AGOSTO-DICIEMBRE", value: 2},
]);
const tipoCurso = ref([
    {value:1, text:"TALLER"},
    {value:2, text:"CURSO"},
    {value:3, text:"CURSO-TALLER"},
    {value:4, text:"FORO"},
    {value:5, text:"SEMINARIO"}
]);
const tipoSolicitud = ref([
    {text: "FORMACIÓN DOCENTE", value:1},
    {text: "ACTUALIZACIÓN PROFESIONAL", value:2}
]);
// functions

function getRow(item){
    itemSelected.value = item
    dialog.value = true
}
const formatDate = computed(() => {
    return new Date(itemSelected.value.fecha_F).toLocaleDateString('es-MX');
})
// Computed propierties
const user = computed(() => usePage().props.user[0]);
const detecciones = computed(() => {
    return usePage().props.deteccionesall.filter(need => {
        return need.aceptado === 0 && need.id_jefe === user.value.docente_id
    })
});

const deteccionesSI = computed(() => {
    return usePage().props.deteccionesall.filter(need => {
        return need.aceptado === 1 && need.id_jefe === user.value.docente_id
    })
});

const dateFormat = computed(() => {
    return new Date(itemSelected.value.fecha_I).toLocaleDateString('es-MX');
})
// hooks
onMounted(() => {

})
</script>

<style scoped>
.titulo {
    justify-content: center;
    align-content: center;
    container: initial;
}
. itemSelected {
    background-color: red;
}
.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
    transition: transform .2s ease-in-out;
}
</style>
