<template>

        <v-layout class="" style="height: 50px">
            <v-app-bar color="blue-lighten-1">
                <Link href="/dashboard" type="button" as="button">
                    <v-btn type="button" size="x-large" icon="mdi-arrow-left">

                    </v-btn>
                </Link>

                <v-app-bar-title class="text-center ml-0 text-h5">{{user.email}}</v-app-bar-title>
            </v-app-bar>
        </v-layout>
        <!--Body-->
        <template v-if="detection.length > 0">
            <v-card class="text-center text-h4" elevation="0">Nuevas</v-card>
            <v-container class="mt-2 pt-2">
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

        <v-card class="text-center text-h4 mt-2 pt-2" elevation="0">Todos los registros</v-card>
        <v-container class="mt-2 pt-2">
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
                                v-for="deteccion in deteccionesaceptadas"
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
                    color="light-blue-darken-1"
                    prominent
                    elevation="7"
                >
                    <v-btn icon dark @click="dialog = false" size="x-large">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>

                    <!--                    <v-toolbar-title>Settings</v-toolbar-title>-->
                    <v-spacer></v-spacer>
                    <template
                        v-if="
                         itemSelected.aceptado === 0
                        "
                    >
                        <v-row justify="center">
                            <v-form @submit.prevent="aceptadoSubmit">
                                    <v-btn
                                        dark
                                        size="x-large"
                                        block
                                        prepend-icon="mdi-check"
                                        type="submit"
                                    >
                                        Aceptar
                                    </v-btn>
                            </v-form>
                            <v-form @submit.prevent="saveCurso">
                                    <v-btn
                                        dark
                                        size="x-large"
                                        block
                                        prepend-icon="mdi-check"
                                        type="submit"
                                    >
                                        Guardar Curso
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
                                                    @submit.prevent="submit"
                                                    ref="form"
                                                >
                                                    <v-text-field
                                                        variant="solo"
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
</template>

<script setup>
//imports
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import axios from "axios";


//props

//variables
let detection = computed(() => usePage().props.detection);
const user = computed(() => usePage().props.user[0]);
let itemSelected = ref({});
let deteccionesaceptadas = computed(() => usePage().props.deteccionesAceptadas);
let dialog = ref(false);
const formO = ref({
    aceptado: null,
    observaciones: "",
});
const formCurso = ref({
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

function submit() {
    router.put(
        "/desarrollo/coordinacion/observaciones" + "/" + itemSelected.value.id,
        formO.value
    );
    reset();
}

function saveCurso(){
    formCurso.value.nameCurso = itemSelected.value.nombreCurso;
    formCurso.value.tipo_curso = itemSelected.value.tipo_FDoAP;
    formCurso.value.objetivo = itemSelected.value.objetivoEvento;
    formCurso.value.fecha_I = itemSelected.value.fecha_I;
    formCurso.value.fecha_F = itemSelected.value.fecha_F;
    formCurso.value.hora_I = itemSelected.value.hora_I;
    formCurso.value.hora_F = itemSelected.value.hora_F;
    formCurso.value.dirigido = itemSelected.value.carrera_dirigido;
    formCurso.value.observaciones = itemSelected.value.observaciones;
    formCurso.value.tipo_actividad = itemSelected.value.tipo_actividad;
    formCurso.value.periodo = itemSelected.value.periodo;
    router.post('/desarrollo/coordinacion/guardado', formCurso.value);
}
function aceptadoSubmit() {
    formO.value.aceptado = 1;
    router.put(
        "/desarrollo/coordinacion/aceptado" + "/" + itemSelected.value.id,
        formO.value
    );
}

function reset() {
    form.value.reset();
}

onMounted(() => {
    axios
        .get("/api/some")
        .then((res) => {
            console.log(res.data);
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>

<style>
. itemSelected {
    background-color: red;
}
h4 {
    margin-left: 12px;
    margin-bottom: 4px;
}
</style>
