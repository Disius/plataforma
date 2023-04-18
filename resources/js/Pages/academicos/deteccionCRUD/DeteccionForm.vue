<template>
 <v-app>
     <v-form @submit.prevent="formN.post('/academicos/save-deteccion')" ref="form">
         <v-toolbar
             outlined
             hide-overlay
             color="light-blue-darken-1"
             dark
             flat
             elevation="6"
             tile
         >

             <v-toolbar-title class="text-h4">Captura de Deteccion de Necesidades</v-toolbar-title>
             <v-spacer></v-spacer>

                <v-btn color="white" type="submit" :disabled="!valid"
                            @click="!validate" prepend-icon="mdi-content-save-check-outline"
                            size="x-large" rounded>
                    Guardar
                </v-btn>

         </v-toolbar>
         <div class="text-center">
             <v-dialog v-model="dialog" width="auto" persistent>
                 <v-card width="500" height="300">
                     <v-card-title class="text-center">Tipo de diagnostico que desea realizar</v-card-title>
                     <v-divider></v-divider>
                     <v-card-text>
                         <v-container class="mt-6">
                             <v-row align="center" justify="center" class="mt-2">
                                 <v-select variant="solo" :items="tipoSolicitud" item-title="text" item-value="value"
                                           v-model="formN.tipo" label="Tipo de solicitud" :rules="requiredRule">

                                 </v-select>
                             </v-row>
                         </v-container>
                     </v-card-text>
                     <v-divider></v-divider>
                     <v-card-actions>
                         <v-container>
                             <v-row justify="end">
                                 <v-col cols="4">
                                     <v-btn prepend-icon="mdi-check-circle" color="green" size="x-large" @click="dialog = false">
                                         Aceptar
                                     </v-btn>
                                 </v-col>
                             </v-row>
                         </v-container>
                     </v-card-actions>
                 </v-card>
             </v-dialog>
         </div>

         <template v-if="formN.tipo === 1">
             <v-container class="mt-5 pt-5">
                 <h2>a)	PRIORIZAR LAS DIMENSIONES DE LA EVALUACIÓN DOCENTE EN LAS QUE REQUIERE LA FORMACIÓN DOCENTE DE EL/LA PROFESOR(A), AVALADOS POR LA ACADEMIA.</h2>
                 <v-row justify="center" class="mt-4">
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Asignaturas en la que se requiere formación o actualización."
                             v-model="formN.AsignaturasFA"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Contenidos temáticos en que se requiere la formación o actualización."
                             v-model="formN.ContenidoTFA"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Número de profesores(as) que la requieren."
                             v-model="formN.Numprofesores"
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             v-model="formN.periodo"
                             :items="period"
                             item-title="text"
                             item-value="value"
                             label="Periodo en el que se requiere la formación o actualización (enero-junio o agosto diciembre)"
                             variant="solo"
                             :rules="requiredRule"
                         >

                         </v-select>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             label="Carrera a la que va dirigido"
                             v-model="formN.dirigido"
                             :items="carreraFilter"
                             item-title="nameCarrera"
                             item-value="id"
                             required
                             variant="solo"
                             :rules="requiredRule"
                         >

                         </v-select>
                     </v-col>
                     <v-col cols="12">
                         <v-autocomplete
                             v-model="formN.facilitadores"
                             variant="solo"
                             :items="docente"
                             item-title="nombre_completo"
                             item-value="id"
                             label="Facilitadores"
                         >

                         </v-autocomplete>
                     </v-col>
                 </v-row>
                 <h2>C)	ACTIVIDADES O EVENTOS  QUE SE LLEVARÁN A CABO PARA LA FORMACIÓN DOCENTE DE EL/LA PROFESOR(A) EN LAS DIMENSIONES DE LA EVALUACIÓN DOCENTE.</h2>
                 <v-row justify="center" class="mt-2">
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Nombre del curso, taller, conferencias, etc."
                             v-model="formN.nombreCT"
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             label="Tipo de Curso"
                             v-model="formN.tipo_act"
                             :items="tipoCurso"
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
                                     <input type="date" class="ml-5" v-model="formN.fecha_I">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                         <v-col cols="6">
                             <v-card elevation="6" width="500" height="100">
                                 <v-card-title>Fecha en que concluira la actividad o evento: </v-card-title>
                                 <v-divider></v-divider>
                                 <v-card-text>
                                     <input type="date" class="ml-5" v-model="formN.fecha_F">
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
                                     <input type="time" class="ml-5" v-model="formN.hora_I">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                         <v-col cols="6">
                             <v-card elevation="6" width="500" height="100">
                                 <v-card-title>Hora de finalización: </v-card-title>
                                 <v-divider></v-divider>
                                 <v-card-text>
                                     <input type="time" class="ml-5" v-model="formN.hora_F">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                     </v-row>
                     <v-col cols="12" class="mt-4">
                         <v-text-field
                             type="text"
                             label="Objetivo de la actividad o evento."
                             v-model="formN.objetivo"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                 </v-row>
             </v-container>
         </template>
         <template v-if="formN.tipo === 2">
             <v-container class="mt-5 pt-5">
                 <h2>b)	PRIORIZAR LAS ASIGNATURAS EN LAS QUE REQUIERE ACTUALIZACIÓN PROFESIONAL DE EL/LA PROFESOR(A), AVALADOS POR LA ACADEMIA.</h2>
                 <v-row justify="center" class="mt-4">
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Asignaturas en la que se requiere formación o actualización."
                             v-model="formN.AsignaturasFA"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Contenidos temáticos en que se requiere la formación o actualización."
                             v-model="formN.ContenidoTFA"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Número de profesores(as) que la requieren."
                             v-model="formN.Numprofesores"
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             v-model="formN.periodo"
                             :items="period"
                             item-title="text"
                             item-value="value"
                             label="Periodo en el que se requiere la formación o actualización (enero-junio o agosto diciembre)"
                             variant="solo"
                             :rules="requiredRule"
                         >

                         </v-select>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             label="Carrera a la que va dirigido"
                             v-model="formN.dirigido"
                             :items="carreraFilter"
                             item-title="nameCarrera"
                             item-value="id"
                             required
                             variant="solo"
                             :rules="requiredRule"
                         >

                         </v-select>
                     </v-col>
                     <v-col cols="12">
                         <v-autocomplete
                             v-model="formN.facilitadores"
                             variant="solo"
                             :items="docente"
                             item-title="nombre_completo"
                             item-value="id"
                             label="Facilitadores"
                             clearable
                         >

                         </v-autocomplete>
                     </v-col>
                 </v-row>
                 <h2>d)	ACTIVIDADES O EVENTOS QUE SE LLEVARÁN A CABO PARA LA ACTUALIZACIÓN DE EL/LA PROFESOR(A) EN ASIGNATURAS QUE SE REQUIERAN</h2>
                 <v-row justify="center" class="mt-2">
                     <v-col cols="12">
                         <v-text-field
                             type="input"
                             label="Nombre del curso, taller, conferencias, etc."
                             v-model="formN.nombreCT"
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                     <v-col cols="12">
                         <v-select
                             label="Tipo de Curso"
                             v-model="formN.tipo_act"
                             :items="tipoCurso"
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
                                     <input type="date" class="ml-5" v-model="formN.fecha_I">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                         <v-col cols="6">
                             <v-card elevation="6" width="500" height="100">
                                 <v-card-title>Fecha en que concluira la actividad o evento: </v-card-title>
                                 <v-divider></v-divider>
                                 <v-card-text>
                                     <input type="date" class="ml-5" v-model="formN.fecha_F">
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
                                     <input type="time" class="ml-5" v-model="formN.hora_I">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                         <v-col cols="6">
                             <v-card elevation="6" width="500" height="100">
                                 <v-card-title>Hora de finalización: </v-card-title>
                                 <v-divider></v-divider>
                                 <v-card-text>
                                     <input type="time" class="ml-5" v-model="formN.hora_F">
                                 </v-card-text>
                             </v-card>
                         </v-col>
                     </v-row>
                     <v-col cols="12" class="mt-4">
                         <v-text-field
                             type="text"
                             label="Objetivo de la actividad o evento."
                             v-model="formN.objetivo"
                             required
                             variant="solo"
                             :rules="textRules"
                         >

                         </v-text-field>
                     </v-col>
                 </v-row>
             </v-container>
         </template>

     </v-form>
 </v-app>
</template>

<script setup>
//imports
import {computed, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {usePage} from "@inertiajs/vue3";

// Variables
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
const carrera = computed(() => usePage().props.carrera);
const docente = computed(() => usePage().props.docentes);
// props

//Functions
function validate(){
    return valid.value = this.$refs.form.validate();
}

const carreraFilter = computed(() => {
    return carrera.value.filter(carer => {
        return carer.departamento_id === user.value.departamento_id
    })
})

onMounted(() => {

})
</script>

<style scoped>

</style>
