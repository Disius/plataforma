<script setup>
//imports
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import axios from "axios";
import Nav from "../../AuthHeader/Nav.vue";


//props
const props = defineProps({
    user: Array,
})
//variables
let detection = computed(() => usePage().props.detection);
let detectionAceptadas = computed(() => {
    console.log(detection)
})
const drawer = ref(true);
let itemSelected = ref({});
let dialog = ref(false);
const allRegistros = ref(false);
const formO = useForm({
    observaciones: "",
});
const formCurso = useForm({
    nameCurso: "",
    tipo_curso: null,
    objetivo: "",
    fecha_I: null,
    fecha_F: null,
    hora_I: null,
    hora_F: null,
    lugar: null,
    dirigido: null,
    duracion: null,
    observaciones: "",
    tipo_actividad: null,
    aceptado: null,
    periodo: null,
});
const form = ref(null);
// functions
function getRow(item) {
    itemSelected.value = item;
    dialog.value = true;
}
const dateFormat = computed(() => {
    return new Date(itemSelected.value.fecha_I).toLocaleDateString("es-MX");
});
const formatDate = computed(() => {
    return new Date(itemSelected.value.fecha_F).toLocaleDateString("es-MX");
});

function submitObservaciones() {
    formO.put("/desarrollo/coordinacion/observaciones" + "/" + itemSelected.value.id)
    reset();
}

function submitAceptado(){

    formCurso.post('/desarrollo/coordinacion/guardado' + '/' + itemSelected.value.id)

}


function reset() {
    form.value.reset();
}

onMounted(() => {
    formCurso.nameCurso = itemSelected.value.nombreCurso;
    formCurso.tipo_curso = itemSelected.value.tipo_FDoAP;
    formCurso.objetivo = itemSelected.value.objetivoEvento;
    formCurso.fecha_I = itemSelected.value.fecha_I;
    formCurso.fecha_F = itemSelected.value.fecha_F;
    formCurso.hora_I = itemSelected.value.hora_I;
    formCurso.hora_F = itemSelected.value.hora_F;
    formCurso.dirigido = itemSelected.value.carrera_dirigido;
    formCurso.observaciones = itemSelected.value.observaciones;
    formCurso.tipo_actividad = itemSelected.value.tipo_actividad;
    formCurso.periodo = itemSelected.value.periodo;
    formCurso.aceptado = 1
});
</script>

<template>
    <v-layout>
        <v-navigation-drawer v-model="drawer">
            <v-list>
                <v-list-item

                >
                    {{props.user[0].email}}
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list color="transparent">
                <Link href="/dashboard" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Inicio"></v-list-item>
                </Link>
                    <Link href="/desarrollo/coordinacion/cursos" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                    </Link>
                    <Link href="/desarrollo/coordinacion/deteccion" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                    </Link>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <Link href="/logout" as="v-btn" method="post">
                        <v-btn block>
                            Logout
                        </v-btn>
                    </Link>
                </div>
            </template>
        </v-navigation-drawer>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-app-bar class="">
            <v-icon size="x-large" class="ml-4" @click="drawer = !drawer">mdi-menu</v-icon>
        </v-app-bar>
        <v-main>
            <template v-if="detection.length > 0">
                <v-container class="mt-2 pt-2">

                    <v-row justify="start">
                        <v-col>
                            <v-sheet
                                class="d-flex justify-start align-center"
                            >
                                <span class="text-h4">Necesidades recientes</span>
                            </v-sheet>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-card elevation="8" width="1500px">
                            <v-table fixed-header height="500px" hover>
                                <thead>
                                <tr>
                                    <th class="text-left">Jefe del departamento</th>
                                    <th class="text-left">Dirigido</th>
                                    <th class="text-left">Tipo de Necesidad</th>
                                    <th class="text-left">Nombre del curso</th>
                                    <th class="text-left">
                                        Asignatura en que requiere formacion y/o
                                        actualización
                                    </th>
                                    <th class="text-left">Contenido tematicos</th>
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
                                    v-for="deteccion in detection"
                                    @click="getRow(deteccion)"
                                    :key="deteccion.id"
                                    :class="{
                                    itemSelected: deteccion === itemSelected,
                                }"
                                >
                                    <td class="v-card--hover">
                                        {{ deteccion.nombreJefe }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.nameCarrera }}
                                    </td>
                                    <template v-if="deteccion.tipo_FDoAP === 1">
                                        <td class="v-card--hover">
                                            FORMACIÓN DOCENTE
                                        </td>
                                    </template>
                                    <template v-if="deteccion.tipo_FDoAP === 2">
                                        <td class="v-card--hover">
                                            ACTUALIZACIÓN PROFESIONAL
                                        </td>
                                    </template>
                                    <td class="v-card--hover">
                                        {{ deteccion.nombreCurso }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.asignaturaFA }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.contenidosTM }}
                                    </td>
                                    <template v-if="deteccion.periodo === 1">
                                        <td class="v-card--hover">ENERO-JUNIO</td>
                                    </template>
                                    <template v-if="deteccion.periodo === 2">
                                        <td class="v-card--hover">
                                            AGOSTO-DICIEMBRE
                                        </td>
                                    </template>
                                    <td class="v-card--hover">
                                        {{ deteccion.objetivoEvento }}
                                    </td>
                                </tr>
                                </tbody>
                            </v-table>
                        </v-card>
                    </v-row>
                </v-container>
            </template>
            <v-col cols="12">
                <v-btn block prepend-icon="mdi-folder" color="light-blue-darken-1" @click="allRegistros = !allRegistros">
                    Ver todos los registros
                </v-btn>
            </v-col>
            <template v-if="detectionAceptadas > 0 && allRegistros === true">
                <v-container class="mt-2 pt-2">
                    <v-row justify="start">
                        <v-col>
                            <v-sheet
                                class="d-flex justify-start align-center"
                            >
                                <span class="text-h6">Todos los registros</span>
                            </v-sheet>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-card elevation="8">
                            <v-table fixed-header height="500px" hover>
                                <thead>
                                <tr>
                                    <th class="text-left">Jefe del departamento</th>
                                    <th class="text-left">Dirigido</th>
                                    <th class="text-left">Tipo de Necesidad</th>
                                    <th class="text-left">Nombre del curso</th>
                                    <th class="text-left">
                                        Asignatura en que requiere formacion y/o
                                        actualización
                                    </th>
                                    <th class="text-left">Contenido tematicos</th>
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
                                    v-for="deteccion in detectionAceptadas"
                                    @click="getRow(deteccion)"
                                    :key="deteccion.id"
                                    :class="{
                                    itemSelected: deteccion === itemSelected,
                                }"
                                >
                                    <td class="v-card--hover">
                                        {{ deteccion.nombreJefe }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.nameCarrera }}
                                    </td>
                                    <template v-if="deteccion.tipo_FDoAP === 1">
                                        <td class="v-card--hover">
                                            FORMACIÓN DOCENTE
                                        </td>
                                    </template>
                                    <template v-if="deteccion.tipo_FDoAP === 2">
                                        <td class="v-card--hover">
                                            ACTUALIZACIÓN PROFESIONAL
                                        </td>
                                    </template>
                                    <td class="v-card--hover">
                                        {{ deteccion.nombreCurso }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.asignaturaFA }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.contenidosTM }}
                                    </td>
                                    <template v-if="deteccion.periodo === 1">
                                        <td class="v-card--hover">ENERO-JUNIO</td>
                                    </template>
                                    <template v-if="deteccion.periodo === 2">
                                        <td class="v-card--hover">
                                            AGOSTO-DICIEMBRE
                                        </td>
                                    </template>
                                    <td class="v-card--hover">
                                        {{ deteccion.objetivoEvento }}
                                    </td>
                                </tr>
                                </tbody>
                            </v-table>
                        </v-card>
                    </v-row>
                </v-container>
            </template>
            <!--        Dialog-->
            <v-dialog
                v-model="dialog"
                fullscreen
                :scrim="false"
                transition="dialog-bottom-transition"
            >
                <v-card class="mx-auto">
                    <v-toolbar
                        dark
                        color="blue-grey-lighten-3"
                        prominent
                        elevation="7"
                    >
                        <v-btn icon dark @click="dialog = false" size="x-large">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>

                        <!--                    <v-toolbar-title>Settings</v-toolbar-title>-->
                        <v-spacer></v-spacer>
                        <template v-if="itemSelected.aceptado === 0">
                            <v-row justify="end" class="mr-16">
                                <v-form @submit.prevent="submitAceptado">
                                    <v-btn
                                        dark
                                        size="x-large"
                                        block
                                        prepend-icon="mdi-check"
                                        type="submit"
                                        class="mr-16 pr-16"
                                    >
                                        Aceptar
                                    </v-btn>
                                </v-form>
                            </v-row>
                        </template>
                    </v-toolbar>
                    <v-container class="mx-auto">
                        <v-row justify="center">
                            <v-sheet
                                :height="970"
                                :width="3000"
                                :elevation="8"
                                class="mt-3 pt-4"
                            >
                                <v-card-title class="text-center text-h5">
                                    {{ itemSelected.nombreCurso }}
                                </v-card-title>
                                <v-spacer></v-spacer>
                                <v-card-text>
                                    <v-container class="pt-4 mt-4">
                                        <v-row align="center" justify="center">
                                            <v-col cols="12">
                                                <h4>
                                                    Asignaturas en la que se
                                                    requiere formación o
                                                    actualización.
                                                </h4>
                                                <v-card
                                                    class="text-center"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.asignaturaFA
                                                    }}</v-card
                                                >
                                            </v-col>
                                            <v-col cols="12">
                                                <h4>
                                                    Contenidos temáticos en que se
                                                    requiere la formación o
                                                    actualización.
                                                </h4>
                                                <v-card
                                                    class="text-center"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.contenidosTM
                                                    }}</v-card
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Número de profesores(as) que la
                                                    requieren.
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.numeroProfesores
                                                    }}</v-card
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Periodo en el que se requiere la
                                                    formación o actualización
                                                    (enero-junio o agosto diciembre)
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        1
                                                    "
                                                    >
                                                        ENERO-JUNIO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        2
                                                    "
                                                    >
                                                        AGOSTO-DICIEMBRE
                                                    </template>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Asignaturas en la que se
                                                    requiere formación o
                                                    actualización.
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.nameCarrera
                                                    }}</v-card
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Facilitador(es)</h4>
                                                <v-card class="" elevation="0">
                                                    <template
                                                        v-for="facilitador in itemSelected.deteccion_facilitador"
                                                    >
                                                        <v-card class="text-h6">{{
                                                                facilitador.nombre_completo
                                                            }}</v-card>
                                                    </template>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                        <v-row justify="center" class="mt-2">
                                            <v-col cols="6">
                                                <h4>
                                                    Nombre del curso, taller,
                                                    conferencias, etc.
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        1
                                                    "
                                                    >
                                                        TALLER
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        2
                                                    "
                                                    >
                                                        CURSO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        3
                                                    "
                                                    >
                                                        CURSO-TALLER
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        4
                                                    "
                                                    >
                                                        FORO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        5
                                                    "
                                                    >
                                                        SEMINARIO
                                                    </template>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Tipo de solicitud</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        1
                                                    "
                                                    >
                                                        FORMACIÓN DOCENTE
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        2
                                                    "
                                                    >
                                                        ACTUALIZACIÓN PROFESIONAL
                                                    </template>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que se realizará la
                                                    actividad o evento:
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ dateFormat }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que concluira la
                                                    actividad o evento:
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ formatDate }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de inicio:</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_I }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de finalización:</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_F }}
                                                </v-card>
                                            </v-col>

                                            <v-col cols="12" class="mt-4">
                                                <h4>
                                                    Objetivo de la actividad o
                                                    evento.
                                                </h4>
                                                <v-card
                                                    class="text-h6 ml-3"
                                                    elevation="0"
                                                >
                                                    {{
                                                        itemSelected.objetivoEvento
                                                    }}
                                                </v-card>
                                            </v-col>
                                            <template
                                                v-if="
                                                itemSelected.aceptado === 0
                                            "
                                            >
                                                <v-col cols="8" class="mt-4">
                                                    <h4>Añadir observaciones</h4>
                                                    <v-form
                                                        @submit.prevent="submitObservaciones"
                                                        ref="form"
                                                    >
                                                        <v-text-field
                                                            v-model="
                                                            formO.observaciones
                                                        "
                                                        >
                                                        </v-text-field>

                                                        <v-btn
                                                            color="light-blue-darken-1"
                                                            type="submit"
                                                        >
                                                            Guardar
                                                        </v-btn>
                                                    </v-form>
                                                </v-col>
                                            </template>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                            </v-sheet>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-main>
    </v-layout>
</template>


<style>
. itemSelected {
    background-color: red;
}
h4 {
    margin-left: 12px;
    margin-bottom: 4px;
}
</style>
