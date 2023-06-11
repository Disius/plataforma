
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
    user: Array,
});
const drawer = ref(true);
const nuevaD = ref(false);
const form = ref();
const modalidad = [
    {text: "Virtual", value:1},
    {text: "Presencial", value:2},
    {text: "Híbrido", value:3},
]
let valid = ref(true);
const user = computed(() => usePage().props.user[0]);
const carrera = computed(() => usePage().props.carrera);
let exist = ref(null)
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
    id_jefe: user.value.docente_id,
    facilitador_externo: ""
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

}
const carreraFilter = computed(() => {
    let filtro = carrera.value.filter(carer => {
         return carer.departamento_id === user.value.departamento_id
    });
    const addTodas =  {nameCarrera: "TODAS LAS CARRERAS", id: 11}

    filtro.push(addTodas);

    return filtro;

});

onMounted(() => {

})
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
                        <v-btn block color="light-blue-darken-1">
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
                    <v-card width="1500" class="ma-12 pa-9" elevation="12">
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
                                        <v-select label="Carrera a la que va dirigida" :items="carreraFilter" item-title="nameCarrera" item-value="id" v-model="formN.dirigido" :rules="textRules">

                                        </v-select>
                                    </v-col>
                                    <v-col >
                                        <v-autocomplete label="Facilitadores">

                                        </v-autocomplete>
                                    </v-col>
                                    <v-col cols="1" align-self="center">
                                        <v-tooltip
                                                        location="top"
                                                    >
                                                        <template v-slot:activator="{ props }">
                                                            <v-btn
                                                                icon
                                                                v-bind="props"
                                                                size="small"
                                                                @click="exist = !exist"
                                                            >
                                                                <v-icon color="blue-lighten-1">
                                                                    mdi-help
                                                                </v-icon>
                                                            </v-btn>
                                                        </template>
                                                            <span>Si el facilitador es una institución</span>
                                                    </v-tooltip>
                                    </v-col>
                                    <v-col  align-self="center">
                                        <v-text-field label="Faciltador" :disabled="!exist" v-model="formN.facilitador_externo"></v-text-field>
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
                                       size="x-large" rounded style="position: relative" @nuevaDeteccion="nuevaD = true">
                                    Guardar
                                </v-btn>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-row>
            </v-form>
        </v-main>
    </v-layout>
</template>

<style scoped>

</style>
