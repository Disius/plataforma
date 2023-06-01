<template>
    <v-layout>
        <v-app-bar color="blue-grey-lighten-3" style="position: fixed">
            <Link as="button" type="button" href="/academicos/detecciones">
                <v-btn icon="mdi-arrow-left" type="button" size="x-large">
                </v-btn>
            </Link>
            <v-app-bar-title class="text-h4 text-center">Deteccion de Necesidades</v-app-bar-title>
        </v-app-bar>
        <v-main>
            <v-form @submit.prevent="submit" ref="form">

                <v-dialog v-model="dialog" width="500" persistent>
                    <v-card width="500" height="300">
                        <v-card-title class="text-center">Tipo de diagnostico que desea realizar</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-container class="mt-6">
                                <v-row align="center" justify="center" class="mt-2">
                                    <v-select :items="tipoSolicitud" item-title="text" item-value="value"
                                              v-model="formN.tipo" label="Tipo de solicitud" :rules="requiredRule">

                                    </v-select>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-row justify="end" class="">
                                <v-col cols="4" align-self="center">
                                    <v-btn prepend-icon="mdi-check-circle" color="green" size="" @click="dialog = false">
                                        Aceptar
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <v-row justify="center">
                    <v-sheet :width="1500" height="500" class="mb-12 pb-9">
                        <template v-if="formN.tipo != null">
                            <v-container class="mt-5">
                                <v-row justify="center">
                                    <template v-if="formN.tipo === 1">
                                        <v-col cols="12" align-self="center">
                                            <v-text-field v-model="formN.AsignaturasFA" label="Dimensión(es) en la(s) que se requiere Formación Docente" :rules="textRules">

                                            </v-text-field>
                                        </v-col>
                                        <!--                                <v-col cols="6">-->
                                        <!--                                    <v-text-field label="Competencia(s) en la(s) que se requiere la Formación Docente">-->

                                        <!--                                    </v-text-field>-->
                                        <!--                                </v-col>-->
                                        <v-col cols="6">
                                            <v-textarea label="Competencia(s) en la(s) que se requiere la Formación Docente" v-model="formN.ContenidoTFA" :rules="textRules">

                                            </v-textarea>
                                        </v-col>
                                    </template>
                                    <template v-if="formN.tipo === 2">
                                        <v-col cols="12" align-self="center">
                                            <v-text-field label="Asignatura(s) en la(s) que se requiere Actualización profesional" v-model="formN.AsignaturasFA" :rules="textRules">

                                            </v-text-field>
                                        </v-col>
                                        <!--                                <v-col cols="6">-->
                                        <!--                                    <v-text-field label="Contenidos temáticos en que se requiere Actualización Profesional">-->

                                        <!--                                    </v-text-field>-->
                                        <!--                                </v-col>-->
                                        <v-col cols="6">
                                            <v-textarea label="Contenidos temáticos en que se requiere Actualización Profesional" v-model="formN.ContenidoTFA" :rules="textRules">

                                            </v-textarea>
                                        </v-col>
                                    </template>
                                    <!--                            <v-row justify="start" class="ml-3">-->
                                    <!--                                <v-tooltip-->
                                    <!--                                    location="right"-->
                                    <!--                                >-->
                                    <!--                                    <template v-slot:activator="{ props }">-->
                                    <!--                                        <v-btn-->
                                    <!--                                            icon-->
                                    <!--                                            v-bind="props"-->
                                    <!--                                            size="x-large"-->
                                    <!--                                            @click=""-->
                                    <!--                                        >-->
                                    <!--                                            <v-icon color="blue-lighten-1">-->
                                    <!--                                                mdi-help-->
                                    <!--                                            </v-icon>-->
                                    <!--                                        </v-btn>-->
                                    <!--                                    </template>-->
                                    <!--                                    <span>Si las competencias o contenidos son en lista y llevan por favor usar el campo de texto grande</span>-->
                                    <!--                                </v-tooltip>-->
                                    <!--                            </v-row>-->
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="6">
                                        <v-text-field label="Número de profesores(as)" v-model="formN.Numprofesores" :rules="textRules">

                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-select label="Periodo de realización (enero-junio o agosto-diciembre)" v-model="formN.periodo" :items="period" item-title="text" item-value="value" :rules="textRules">

                                        </v-select>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-select label="Modalidad" :items="modalidad" item-title="text" item-value="value" v-model="formN.modalidad" :rules="textRules">

                                        </v-select>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-select label="Tipo de curso" :items="tipoCurso" item-title="text" item-value="value" v-model="formN.tipo_act" :rules="textRules">

                                        </v-select>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select label="Carrera a la que va dirigida" :items="props.carrera" item-title="nameCarrera" item-value="id" v-model="formN.dirigido" :rules="textRules">

                                        </v-select>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-autocomplete label="Facilitadores">

                                        </v-autocomplete>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="Nombre del curso, taller, conferencias, etc." v-model="formN.nombreCT" :rules="textRules">

                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <h4>Elegir las fechas en que se
                                            realizará la actividad
                                            o evento</h4>
                                        <v-row justify="center">
                                            <v-col cols="6">
                                                <v-text-field type="date" v-model="formN.fecha_I"/>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field type="date" v-model="formN.fecha_F"/>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                    <v-col cols="6">
                                        <h4>Elegir los horarios en que
                                            se realizará la
                                            actividad o
                                            evento</h4>
                                        <v-row justify="center">
                                            <v-col cols="6">
                                                <v-text-field type="time" v-model="formN.hora_I"></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field type="time" v-model="formN.hora_F"/>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                    <v-col align-self="center" cols="12">
                                        <v-text-field v-model="formN.objetivo" label="Objetivo de la actividad o evento" :rules="textRules">

                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </template>

                        <v-container class="mt-6 mb-6">
                            <v-row justify="center">
                                <v-btn color="blue-lighten-1" type="submit" :disabled="!valid" block
                                       @click="!validate" prepend-icon="mdi-content-save-check-outline"
                                       size="x-large" rounded style="position: relative">
                                    Guardar
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-sheet>
                </v-row>
            </v-form>
        </v-main>
    </v-layout>
</template>

<script setup>
//imports
import {computed, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {usePage} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";

// Variables
const props = defineProps({
    carrera: null,
    departamento: null,
    docente: null,
});
const form = ref();
const modalidad = [
    {text: "Virtual", value:1},
    {text: "Presencial", value:2},
    {text: "Híbrido", value:3},
]
let valid = ref(true);
const user = computed(() => usePage().props.user[0]);
const tipoSolicitud = ref([
    {text: "FORMACIÓN DOCENTE", value:1},
    {text: "ACTUALIZACIÓN PROFESIONAL", value:2}
])
const tipoCurso = ref([
    {value:1, text:"TALLER"},
    {value:2, text:"CURSO"},
    {value:3, text:"CURSO-TALLER"},
    {value:4, text:"FORO"},
    {value:5, text:"SEMINARIO"}
]);
const dialog = ref(true);
const formN = useForm({
    AsignaturasFA: "",
    ContenidoTFA: "",
    Numprofesores: null,
    periodo: null,
    facilitadores: [],
    nombreCT: "",
    fecha_I: "",
    fecha_F: "",
    hora_I: "",
    hora_F: "",
    objetivo: "",
    tipo: null,
    tipo_act: null,
    dirigido: null,
    modalidad: null,
    id_jefe: user.value.docente_id
});
const period = ref([
    {text: "ENERO-JUNIO", value: 1},
    {text: "AGOSTO-DICIEMBRE", value: 2},
]);

const textRules = ref([
    (v) => !!v ||  "Este campo es requerido"
]);

const requiredRule = ref([
    (v) => !!v || 'Este dato es requerido',
]);


// props

//Functions
function validate(){
    return valid.value = this.$refs.form.validate();
}
function reset(){
    form.value.reset()
}

const submit = () => {
    formN.post('/academicos/save-deteccion')
    reset()
    dialog.value = true
}
const carreraFilter = computed(() => {
    // let filtro = carrera.value.filter(carer => {
    //      return carer.departamento_id === user.value.departamento_id
    // });
    // const addTodas =  {nameCarrera: "TODAS LAS CARRERAS", id: 11}
    //
    // filtro.push(addTodas);
    //
    // return filtro;

});

onMounted(() => {

})
</script>

<style scoped>

</style>
