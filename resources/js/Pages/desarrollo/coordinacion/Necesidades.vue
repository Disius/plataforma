<script setup>
//imports
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import DesarrolloHeader from "../header/DesarrolloHeader.vue";


//props
const props = defineProps({
    user: Array,
    detection: Array,
})
//variables
let itemSelected = ref({});
let dialog = ref(false);
const formO = useForm({
    observaciones: "",
});
const Form = useForm({
    aceptado: Number,
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

    Form.post('/desarrollo/coordinacion/guardado' + '/' + itemSelected.value.id)

}


function reset() {
    form.value.reset();
}

onMounted(() => {
    Form.aceptado = 1
});
</script>

<template>
    <v-layout>
        <DesarrolloHeader :usuario="props.user"/>
        <v-main class="ml-0">
            <v-container class="mt-2 pt-2">

                <v-row justify="center" class="mt-4">
                            <v-sheet
                                class="d-flex justify-start align-center"
                            >
                                <span class="text-h4">Necesidades recientes</span>
                            </v-sheet>
                </v-row>
                <v-row justify="center" class="mt-7 pt-7">
                        <v-card elevation="8" width="1570px">
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
                                    v-for="deteccion in props.detection"
                                    @click="getRow(deteccion)"
                                    :key="deteccion.id"
                                    :class="{
                                    itemSelected: deteccion === itemSelected,
                                }"
                                >
                                    <td class="v-card--hover">
                                        {{ deteccion.jefe.nombre }} {{ deteccion.jefe.apellidoPat }} {{ deteccion.jefe.apellidoMat }}
                                    </td>
                                    <td class="v-card--hover">
                                        {{ deteccion.carrera.nameCarrera }}
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
            <Link href="/desarrollo/coordinacion/registros" as="v-btn" type="v-btn">
                <v-col cols="12" class="mt-12 pt-12">
                    <v-btn block prepend-icon="mdi-folder" color="light-blue-darken-1">
                        Ver todos los registros
                    </v-btn>
                </v-col>
            </Link>
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
                        color="light-blue-darken-4"
                        prominent
                        elevation="7"
                        style="position: fixed;"
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
                    <v-container class="mt-16">
                        <v-row justify="center">

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
                                                <p
                                                    class="text-center"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.asignaturaFA
                                                    }}</p
                                                >
                                            </v-col>
                                            <v-col cols="12">
                                                <h4>
                                                    Contenidos temáticos en que se
                                                    requiere la formación o
                                                    actualización.
                                                </h4>
                                                <p
                                                    class="text-center"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.contenidosTM
                                                    }}</p
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Número de profesores(as) que la
                                                    requieren.
                                                </h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.numeroProfesores
                                                    }}</p
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Periodo en el que se requiere la
                                                    formación o actualización
                                                    (enero-junio o agosto diciembre)
                                                </h4>
                                                <p
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
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Asignaturas en la que se
                                                    requiere formación o
                                                    actualización.
                                                </h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >{{
                                                        itemSelected.nameCarrera
                                                    }}</p
                                                >
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Facilitador(es)</h4>
                                                <p class="" elevation="0">
                                                    <template
                                                        v-for="facilitador in itemSelected.deteccion_facilitador"
                                                    >
                                                        <v-card class="text-h6">{{
                                                                facilitador.nombre_completo
                                                            }}</v-card>
                                                    </template>
                                                </p>
                                            </v-col>
                                        </v-row>
                                        <v-row justify="center" class="mt-2">
                                            <v-col cols="6">
                                                <h4>
                                                    Nombre del curso, taller,
                                                    conferencias, etc.
                                                </h4>
                                                <p
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
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Tipo de solicitud</h4>
                                                <p
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
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que se realizará la
                                                    actividad o evento:
                                                </h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ dateFormat }}
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que concluira la
                                                    actividad o evento:
                                                </h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ formatDate }}
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de inicio:</h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_I }}
                                                </p>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de finalización:</h4>
                                                <p
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_F }}
                                                </p>
                                            </v-col>

                                            <v-col cols="12" class="mt-4">
                                                <h4>
                                                    Objetivo de la actividad o
                                                    evento.
                                                </h4>
                                                <p
                                                    class="text-h6 ml-3"
                                                    elevation="0"
                                                >
                                                    {{
                                                        itemSelected.objetivoEvento
                                                    }}
                                                </p>
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
