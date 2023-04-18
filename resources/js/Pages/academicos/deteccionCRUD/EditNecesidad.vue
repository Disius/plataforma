<template>
   <v-form ref="form" @submit.prevent="submit">
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

               <v-btn color="white" type="submit" :disabled="!valid"
                      @click="!validate" prepend-icon="mdi-content-save-check-outline"
                      size="x-large" rounded>
                   Editar
               </v-btn>
           </v-toolbar>
       </v-card>
       <v-container class="pt-4 mt-4">
           <v-row align="center" justify="center">
               <v-col cols="12">
                   <v-text-field
                       type="input"
                       label="Asignaturas en la que se requiere formación o actualización."
                       required
                       variant="solo"
                       :rules="textRules"
                       v-model="formEdit.AsignaturasFA"
                   >

                   </v-text-field>
               </v-col>
               <v-col cols="12">
                   <v-text-field
                       type="input"
                       label="Contenidos temáticos en que se requiere la formación o actualización."
                       required
                       variant="solo"
                       :rules="textRules"
                       v-model="formEdit.ContenidoTFA"
                   >

                   </v-text-field>
               </v-col>
               <v-col cols="12">
                   <v-text-field
                       type="input"
                       label="Número de profesores(as) que la requieren."
                       variant="solo"
                       :rules="textRules"
                       v-model="formEdit.Numprofesores"
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
                       :rules="requiredRule"
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
                       required
                       variant="solo"
                       disable
                       :rules="requiredRule"
                       v-model="formEdit.dirigido"
                   >

                   </v-select>
               </v-col>
               <v-col cols="6">
                   <h4>Facilitador(es)</h4>
                   <template v-for="facilitador in relation.deteccion_facilitador"
                             :key="facilitador.id"
                   >
                       <v-card class="text-center text-h6" elevation="0">
                           {{facilitador.nombre_completo}}
                       </v-card>
                   </template>
               </v-col>

               <v-col cols="6">
                   <h4>Elegir nuevo o cambiar facilitador(es)</h4>
                   <v-autocomplete
                       variant="solo"
                       :items="teacher"
                       item-title="nombre_completo"
                       item-value="id"
                       label="Facilitadores"
                   >

                   </v-autocomplete>
               </v-col>
           </v-row>
           <v-row justify="center" class="mt-2">
               <v-col cols="6">
                   <v-text-field
                       type="input"
                       label="Nombre del curso, taller, conferencias, etc."
                       variant="solo"
                       :rules="textRules"
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
                       :rules="requiredRule"
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
                       :rules="requiredRule"
                   >

                   </v-select>
               </v-col>
               <v-row justify="center" class="ml-3">
                   <v-col cols="6">
                       <v-card elevation="6" width="500" height="100">
                           <v-card-title>Fecha en que se realizará la actividad o evento: </v-card-title>
                           <v-divider></v-divider>
                           <v-card-text>
                               <input type="date" class="ml-5">
                           </v-card-text>
                       </v-card>
                   </v-col>
                   <v-col cols="6">
                       <v-card elevation="6" width="500" height="100">
                           <v-card-title>Fecha en que concluira la actividad o evento: </v-card-title>
                           <v-divider></v-divider>
                           <v-card-text>
                               <input type="date" class="ml-5">
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
                               <input type="time" class="ml-5">
                           </v-card-text>
                       </v-card>
                   </v-col>
                   <v-col cols="6">
                       <v-card elevation="6" width="500" height="100">
                           <v-card-title>Hora de finalización: </v-card-title>
                           <v-divider></v-divider>
                           <v-card-text>
                               <input type="time" class="ml-5">
                           </v-card-text>
                       </v-card>
                   </v-col>
               </v-row>
               <v-col cols="12" class="mt-4">
                   <v-text-field
                       type="text"
                       label="Objetivo de la actividad o evento."
                       variant="solo"
                       :rules="textRules"
                   >

                   </v-text-field>
               </v-col>
           </v-row>
       </v-container>
   </v-form>
</template>

<script setup>
//imports
import AcademicosMain from "../../Navigation/AcademicosMain.vue";
import {computed, onMounted, ref} from "vue";
import axios from "axios";
import {router, useForm, usePage} from "@inertiajs/vue3";
// variables
const textRules = ref([
    (v) => !!v ||  "Este campo es requerido"
]);

const requiredRule = ref([
    (v) => !!v || 'Este dato es requerido',
]);
let valid = ref(true);
const user = computed(() => usePage().props.user[0]);
const carrera = computed(() => usePage().props.carrera);
let deteccion = computed(() => usePage().props.deteccionSelect)
let teacher = ref([]);
const period = ref([
    {text: "ENERO-JUNIO", value: 1},
    {text: "AGOSTO-DICIEMBRE", value: 2},
]);
const tipoSolicitud = ref([
    {text: "FORMACIÓN DOCENTE", value:1},
    {text: "ACTUALIZACIÓN PROFESIONAL", value:2}
]);
const tipoCurso = ref([
    {value:1, text:"TALLER"},
    {value:2, text:"CURSO"},
    {value:3, text:"CURSO-TALLER"},
    {value:4, text:"FORO"},
    {value:5, text:"SEMINARIO"}
]);
const formEdit = useForm({
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
    id_jefe: user.value.docente_id
});
// props
defineProps({
    deteccionSelect: {},
    relation: null,
})
//functions
function validate(){
    return valid.value = this.$refs.form.validate();
}

function submit(){
    router.put('/academicos/edited-deteccion' + '/' + deteccion.value.id, deteccion.value);
}
// promesas
function getDocente(){
    return new Promise((response, reject) => {
        axios.get('/api/registros-docente').then(res => {
            response(res.data);
        }).catch(error => {
            reject(error)
        })
    });
}

// computed properties
const filtroCarrera = computed(() => {
    return carrera.value.filter(carer => {
        return carer.departamento_id === user.value.departamento_id
    })
});


// hooks
onMounted(() => {
    getDocente().then(res => {
        teacher.value = res
    }).catch(error => {
        console.log(error)
    })
})
</script>

<style scoped>

</style>
