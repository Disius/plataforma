<template>
    <v-layout>
        <v-app-bar color="blue-grey-lighten-3" style="position: fixed">
            <Link as="v-btn" type="v-btn" href="/academicos/detecciones">
                <v-btn icon="mdi-arrow-left" type="button" size="x-large">
                </v-btn>
            </Link>
            <v-app-bar-title class="text-h4 text-center"></v-app-bar-title>
        </v-app-bar>
        <v-main>
            <v-container class="mt-8 pt-8">
                <v-form @submit.prevent="submit">
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field clearable v-model="props.deteccionSelect.nombreCurso" label="Nombre del curso"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field clearable v-model="props.deteccionSelect.asignaturaFA" label="Asignatura en la que requiere FD o AP"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea clearable v-model="props.deteccionSelect.contenidosTM" label="Contenidos tematicos"></v-textarea>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field clearable v-model="props.deteccionSelect.numeroProfesores" label="Numero de profesores requerido"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field type="date" clearable v-model="props.deteccionSelect.fecha_I" label="Fecha de inicio de la actividad"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field type="date" clearable v-model="props.deteccionSelect.fecha_F" label="Fecha de finalizacion de la actividad"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field type="time" clearable v-model="props.deteccionSelect.hora_I" label="Hora de inicio de la actividad"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field type="time" clearable v-model="props.deteccionSelect.hora_F" label="Hora de finalización de la actividad"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-select label="Periodo de realización" clearable v-model="props.deteccionSelect.periodo" :items="period" item-value="value" item-title="text"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select label="Carrera a la que va dirigido" clearable v-model="props.deteccionSelect.carrera_dirigido" :items="carrera" item-value="id" item-title="nameCarrera"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select label="Tipo de solicitud" clearable v-model="props.deteccionSelect.tipo_FDoAP" :items="tipoSolicitud" item-value="value" item-title="text"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select label="Tipo de actividad" clearable v-model="props.deteccionSelect.tipo_actividad" :items="tipoCurso" item-value="value" item-title="text"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select label="Modalidad" clearable v-model="props.deteccionSelect.modalidad" :items="modalidad" item-value="value" item-title="text"></v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field clearable v-model="props.deteccionSelect.objetivoEvento" label="Asignatura en la que requiere FD o AP"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row justify="center" class="mt-5 pt-5">
                        <v-btn size="x-large" block color="blue-darken-1" type="submit">
                            Editar
                        </v-btn>
                    </v-row>
                </v-form>
            </v-container>
        </v-main>
    </v-layout>
</template>

<script setup>
//imports
import { computed, onMounted, ref } from "vue";
import axios from "axios";
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
// variables

const props = defineProps({
    deteccionSelect: null,
    carrera: null,
    relation: null,
});
const isEditing = ref(false);
const textRules = ref([(v) => !!v || "Este campo es requerido"]);
const requiredRule = ref([(v) => !!v || "Este dato es requerido"]);
let valid = ref(true);
const user = computed(() => usePage().props.user[0]);
const modalidad = [
    {text: "Virtual", value:1},
    {text: "Presencial", value:2},
    {text: "Híbrido", value:3},
]
let teacher = ref([]);
const period = ref([
    { text: "ENERO-JUNIO", value: 1 },
    { text: "AGOSTO-DICIEMBRE", value: 2 },
]);
const tipoSolicitud = ref([
    { text: "FORMACIÓN DOCENTE", value: 1 },
    { text: "ACTUALIZACIÓN PROFESIONAL", value: 2 },
]);
const tipoCurso = ref([
    { value: 1, text: "TALLER" },
    { value: 2, text: "CURSO" },
    { value: 3, text: "CURSO-TALLER" },
    { value: 4, text: "FORO" },
    { value: 5, text: "SEMINARIO" },
]);
const formEdit = useForm({
    asignaturaFA: "",
    contenidosTM: "",
    numeroProfesores: null,
    periodo: null,
    facilitadores: [],
    nombreCurso: "",
    fecha_I: "",
    fecha_F: "",
    hora_I: "",
    hora_F: "",
    objetivoEvento: "",
    tipo_FDoAP: null,
    tipo_actividad: null,
    carrera_dirigido: null,
    id_jefe: user.value.docente_id,
});
//functions
function validate() {
    return (valid.value = this.$refs.form.validate());
}

// computed properties
// const filtroCarrera = computed(() => {
//     return props.carrera.filter((carer) => {
//         return carer.departamento_id === user.value.departamento_id;
//     });
// });
function submit(){
    formEdit.asignaturaFA = props.deteccionSelect.asignaturaFA
    formEdit.contenidosTM = props.deteccionSelect.contenidosTM
    formEdit.numeroProfesores = props.deteccionSelect.numeroProfesores
    formEdit.periodo = props.deteccionSelect.periodo
    formEdit.nombreCurso = props.deteccionSelect.nombreCurso
    formEdit.fecha_I = props.deteccionSelect.fecha_I
    formEdit.fecha_F = props.deteccionSelect.fecha_F
    formEdit.hora_I = props.deteccionSelect.hora_I
    formEdit.hora_F = props.deteccionSelect.hora_F
    formEdit.tipo_FDoAP = props.deteccionSelect.tipo_FDoAP
    formEdit.tipo_actividad = props.deteccionSelect.tipo_actividad
    formEdit.carrera_dirigido = props.deteccionSelect.carrera_dirigido
    formEdit.objetivoEvento = props.deteccionSelect.objetivoEvento

    formEdit.put('/academicos/edited-deteccion' + '/' + props.deteccionSelect.id)
}

</script>

<style scoped>
.inputStyle {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border-radius: 50px;
    border-color: black;
    border-style: solid;
}
</style>
