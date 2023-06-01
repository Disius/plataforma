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
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">

                    </v-col>
                </v-row>
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
