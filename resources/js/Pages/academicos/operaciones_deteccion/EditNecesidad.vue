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
    user: Array,
});
const drawer = ref(true);
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
    modalidad: null,
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
    formEdit.modalidad = props.deteccionSelect.modalidad
    formEdit.facilitador_externo = props.deteccionSelect.facilitador_externo

    formEdit.put('/academicos/edited-deteccion' + '/' + props.deteccionSelect.id)
}

</script>
<template>
    <v-layout>
        <v-navigation-drawer v-model="drawer" color="light-blue-darken-4">
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

                <Link href="/academicos/cursos" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                </Link>
                <Link href="/academicos/detecciones" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                </Link>

                <Link href="/docentes/mis-datos" as="v-list-item">
                     <v-list-item link prepend-icon="" title="Mi información"></v-list-item>
                </Link>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <Link href="/logout" as="v-btn" method="post">
                        <v-btn blockc color="light-blue-darken-1">
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
            <v-container class="mt-3 pt-3">
                <v-form @submit.prevent="submit">
                    <v-row justify="center">
                            <v-card width="1500" elevation="5" class="pa-8 ma-8">
                                <v-col cols="12">
                                <v-text-field clearable v-model="props.deteccionSelect.nombreCurso" label="Nombre del curso"></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field clearable v-model="props.deteccionSelect.asignaturaFA" label="Asignatura en la que requiere FD o AP"></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea clearable v-model="props.deteccionSelect.contenidosTM" label="Contenidos tematicos"></v-textarea>
                            </v-col>
                            <v-col>
                                <v-text-field clearable v-model="props.deteccionSelect.numeroProfesores" label="Numero de profesores requerido"></v-text-field>
                            </v-col>
                            <v-col>
                                    <v-autocomplete label="Facilitadores">

                                    </v-autocomplete>
                            </v-col>
                                        
                            <v-col align-self="center">
                                <v-text-field label="Faciltador externo" v-model="props.deteccionSelect.facilitador_externo"></v-text-field>
                            </v-col>
                            <v-col >
                                <v-text-field type="date" clearable v-model="props.deteccionSelect.fecha_I" label="Fecha de inicio de la actividad"></v-text-field>
                            </v-col>
                            <v-col >
                                <v-text-field type="date" clearable v-model="props.deteccionSelect.fecha_F" label="Fecha de finalizacion de la actividad"></v-text-field>
                            </v-col>
                            <v-col >
                                <v-text-field type="time" clearable v-model="props.deteccionSelect.hora_I" label="Hora de inicio de la actividad"></v-text-field>
                            </v-col>
                            <v-col >
                                <v-text-field type="time" clearable v-model="props.deteccionSelect.hora_F" label="Hora de finalización de la actividad"></v-text-field>
                            </v-col>
                            <v-col >
                                <v-select label="Periodo de realización" clearable v-model="props.deteccionSelect.periodo" :items="period" item-value="value" item-title="text"></v-select>
                            </v-col>
                            <v-col >
                                <v-select label="Carrera a la que va dirigido" clearable v-model="props.deteccionSelect.carrera_dirigido" :items="carrera" item-value="id" item-title="nameCarrera"></v-select>
                            </v-col>
                            <v-col >
                                <v-select label="Tipo de solicitud" clearable v-model="props.deteccionSelect.tipo_FDoAP" :items="tipoSolicitud" item-value="value" item-title="text"></v-select>
                            </v-col>
                            <v-col >
                                <v-select label="Tipo de actividad" clearable v-model="props.deteccionSelect.tipo_actividad" :items="tipoCurso" item-value="value" item-title="text"></v-select>
                            </v-col>
                            <v-col >
                                <v-select label="Modalidad" clearable v-model="props.deteccionSelect.modalidad" :items="modalidad" item-value="value" item-title="text"></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field clearable v-model="props.deteccionSelect.objetivoEvento" label="Objtivo del evento"></v-text-field>
                            </v-col>
                    
                                <v-row justify="center" class="ma-5 pa-5">
                                    <v-btn size="x-large" block color="blue-darken-1" type="submit">
                                        Editar
                                    </v-btn>
                                </v-row>
                        </v-card>
                </v-row>
                </v-form>
            </v-container>
        </v-main>
    </v-layout>
</template>

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
