<template>
    <v-form
        ref="form"
        @submit.prevent="
            formEdit.put('/academicos/edited-deteccion' + '/' + deteccion.id)
        "
    >
        <v-card
            color="light-blue-darken-1"
            flat
            rounded="0"
            elevation="6"
            prominent
        >
            <v-toolbar extended color="light-blue-darken-1">
                <v-toolbar-title class="text-h5">{{
                    user.email
                }}</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn
                    color="white"
                    type="submit"
                    :disabled="!valid"
                    @click="!validate"
                    prepend-icon="mdi-content-save-check-outline"
                    size="x-large"
                    rounded
                >
                    Guardar
                </v-btn>
            </v-toolbar>
        </v-card>
        <v-container class="pt-4 mt-4">
            <v-row align="center" justify="center">
                <v-col cols="12">
                    <v-text-field
                        type="input"
                        label="Asignaturas en la que se requiere formación o actualización."
                        variant="solo"
                        v-model="formEdit.asignaturaFA"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        type="input"
                        label="Contenidos temáticos en que se requiere la formación o actualización."
                        variant="solo"
                        v-model="formEdit.contenidosTM"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        type="input"
                        label="Número de profesores(as) que la requieren."
                        variant="solo"
                        v-model="formEdit.numeroProfesores"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-select
                        :items="period"
                        item-title="text"
                        item-value="value"
                        label="Periodo en el que se requiere la formación o actualización (enero-junio o agosto diciembre)"
                        variant="solo"
                        v-model="formEdit.periodo"
                    >
                    </v-select>
                </v-col>
                <v-col cols="6">
                    <v-select
                        label="Carrera a la que va dirigido"
                        :items="filtroCarrera"
                        item-title="nameCarrera"
                        item-value="id"
                        variant="solo"
                        v-model="formEdit.carrera_dirigido"
                    >
                    </v-select>
                </v-col>
                <v-col cols="6">
                    <h4>Facilitador(es)</h4>
                    <template
                        v-for="facilitador in relation"
                        :key="facilitador.id"
                    >
                        <v-card class="text-center text-h6" elevation="0">
                            {{ facilitador.nombre_completo }}
                        </v-card>
                    </template>
                </v-col>

                <v-col cols="6">
                    <h4>Elegir nuevo o cambiar facilitador(es)</h4>
                    <v-autocomplete
                        v-model="formEdit.facilitadores"
                        :hint="!isEditing ? 'Editar' : 'Lectura'"
                        :label="`Facilitador - ${
                            isEditing ? 'Editable' : 'Solo lectura'
                        }`"
                        :items="teacher"
                        :readonly="!isEditing"
                        variant="solo"
                        item-title="nombre_completo"
                        item-value="id"
                        multiple
                    >
                        <template v-slot:append>
                            <v-slide-x-reverse-transition mode="out-in">
                                <v-icon
                                    :key="`icon-$(isEditing)`"
                                    :color="isEditing ? 'success' : 'info'"
                                    :icon="
                                        isEditing
                                            ? 'mdi-check-outline'
                                            : 'mdi-file-edit'
                                    "
                                    @click="isEditing = !isEditing"
                                >
                                </v-icon>
                            </v-slide-x-reverse-transition>
                        </template>
                    </v-autocomplete>
                </v-col>
            </v-row>
            <v-row justify="center" class="mt-2">
                <v-col cols="6">
                    <v-text-field
                        type="input"
                        label="Nombre del curso, taller, conferencias, etc."
                        variant="solo"
                        v-model="formEdit.nombreCurso"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-select
                        label="Tipo de Curso"
                        :items="tipoCurso"
                        item-value="value"
                        item-title="text"
                        variant="solo"
                        v-model="formEdit.tipo_actividad"
                    >
                    </v-select>
                </v-col>
                <v-col cols="12">
                    <v-select
                        label="Tipo de solicitud"
                        :items="tipoSolicitud"
                        item-value="value"
                        item-title="text"
                        variant="solo"
                        v-model="formEdit.tipo_FDoAP"
                    >
                    </v-select>
                </v-col>
                <v-row justify="center" class="ml-3">
                    <v-col cols="6">
                        <v-card elevation="6" width="500" height="100">
                            <v-card-title
                                >Fecha en que se realizará la actividad o
                                evento:
                            </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                                <input
                                    type="date"
                                    class="ml-5"
                                    v-model="formEdit.fecha_I"
                                />
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="6">
                        <v-card elevation="6" width="500" height="100">
                            <v-card-title
                                >Fecha en que concluira la actividad o evento:
                            </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                                <input
                                    type="date"
                                    class="ml-5"
                                    v-model="formEdit.fecha_F"
                                />
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row justify="center" class="ml-3">
                    <v-col cols="6">
                        <v-card elevation="6" width="500" height="100">
                            <v-card-title>Hora de inicio: </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                                <input
                                    type="time"
                                    class="ml-5"
                                    v-model="formEdit.hora_I"
                                />
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="6">
                        <v-card elevation="6" width="500" height="100">
                            <v-card-title>Hora de finalización: </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                                <input
                                    type="time"
                                    class="ml-5"
                                    v-model="formEdit.hora_F"
                                />
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <v-col cols="12" class="mt-4">
                    <v-text-field
                        type="text"
                        label="Objetivo de la actividad o evento."
                        variant="solo"
                        v-model="formEdit.objetivoEvento"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
        </v-container>
    </v-form>

    <v-layout class="overflow-visible" style="height: 56px">
        <v-bottom-navigation v-model="value" color="light-blue-darken-1" grow>
            <Link href="/academicos/detecciones" type="button" as="button">
                <v-btn type="button">
                    <v-icon>mdi-arrow-left</v-icon>

                    Volver a Detecciones de Necesidades
                </v-btn>
            </Link>
        </v-bottom-navigation>
    </v-layout>
</template>

<script setup>
//imports
import { computed, onMounted, ref } from "vue";
import axios from "axios";
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
// variables
const isEditing = ref(false);
const textRules = ref([(v) => !!v || "Este campo es requerido"]);

const requiredRule = ref([(v) => !!v || "Este dato es requerido"]);
let valid = ref(true);
const user = computed(() => usePage().props.user[0]);
const carrera = computed(() => usePage().props.carrera);
let deteccion = computed(() => usePage().props.deteccionSelect);
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
// props
defineProps({
    deteccionSelect: {},
    relation: null,
});
//functions
function validate() {
    return (valid.value = this.$refs.form.validate());
}
// promesas
function getDocente() {
    return new Promise((response, reject) => {
        axios
            .get("/api/registros-docente")
            .then((res) => {
                response(res.data);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

// computed properties
const filtroCarrera = computed(() => {
    return carrera.value.filter((carer) => {
        return carer.departamento_id === user.value.departamento_id;
    });
});

// hooks
onMounted(() => {
    getDocente()
        .then((res) => {
            teacher.value = res;
        })
        .catch((error) => {
            console.log(error);
        });
});
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
