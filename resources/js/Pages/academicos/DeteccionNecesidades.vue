<template>
     <v-layout class="" style="height: 50px">
          <v-app-bar
              extended
              color="blue-grey-lighten-3"
              absolute
          >

                  <Link href="/dashboard" as="button" type="button">
                      <v-btn icon class="ml-8" size="x-large">
                          <v-icon icon="mdi-arrow-left" style=""></v-icon>
                      </v-btn>
                  </Link>

                <v-img class="d-flex justify-center align-center mt-10"
                       width="100"
                       heigth="200"
                       src="http://plataforma-docente.test/storage/Tec-Tuxtla_Logo.png"
                >
                </v-img>
                <v-app-bar-title class="text-h5 text-center">{{user.email}}</v-app-bar-title>
                <v-img class="d-flex justify-end  mt-10 mr-4"
                       width="200"
                       heigth="400"
                       src="http://plataforma-docente.test/storage/tecnm.jpg"
                >
                </v-img>
            </v-app-bar>

         <v-main>
             <v-container class="mt-2 pt-2">
                 <v-row justify="start" class="md-4">
                     <v-col cols="3">
                         <v-menu>
                             <template v-slot:activator="{ props }">
                                 <v-btn v-bind="props" size="x-large" color="blue-grey-lighten-5" block>
                                     <v-icon>mdi-file-pdf-box</v-icon>
                                 </v-btn>
                             </template>
                             <v-list>
                                 <v-list-item
                                     v-for="(item, index) in menu"
                                     :key="item.id"
                                     :value="item.id"
                                 >
                                     <v-list-item-title @click="dialogPDF = true">{{ item.name }}</v-list-item-title>
                                 </v-list-item>
                             </v-list>
                         </v-menu>
                     </v-col>
                 </v-row>
             </v-container>
             <v-container fluid class="pa-0">
                 <v-row justify="center">
                     <v-col cols="5">
                         <Link href="/academicos/crear-deteccion" as="card" type="card">
                             <v-card
                                 elevation="8"
                                 height="300px"
                                 class="d-flex justify-center align-center"
                                 link
                                 type="card"
                             >
                                 <span class="text-h4 text-center">Crear Deteccion de Necesidades</span>
                             </v-card>
                         </Link>
                     </v-col>
                 </v-row>
             </v-container>
             <template v-if="props.deteccionesall.length > 0">
                 <v-container>
                     <v-row justify="start">
                        <v-col>
                            <v-sheet
                                class="d-flex justify-start align-center"
                            >
                                <span class="text-h6">Necesidades recientes</span>
                            </v-sheet>
                        </v-col>
                     </v-row>
                  </v-container>
                 <v-container>
                     <v-row justify="center">
                         <v-col cols="12">
                             <v-card elevation="7">
                                 <v-table
                                     fixed-header
                                     height="300px"
                                     hover
                                 >
                                     <thead>
                                     <tr>
                                         <th class="text-left">
                                             Dirigido
                                         </th>
                                         <th class="text-left">
                                             Nombre del curso
                                         </th>
                                         <th class="text-left">
                                             Contenido tematicos
                                         </th>
                                         <th class="text-left">
                                             Periodo de Realización
                                         </th>
                                         <th class="text-left">
                                             Objetivo de la actividad o evento
                                         </th>
                                         <template v-if="observaciones === true">
                                             <th class="text-left">
                                                 Observaciones
                                             </th>
                                         </template>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     <tr
                                         v-for="deteccion in props.deteccionesall" @click="getRow(deteccion)"
                                         :key="deteccion.id" :class="{ itemSelected: deteccion === itemSelected }"

                                     >
                                         <td class="v-card--hover">{{deteccion.nameCarrera}}</td>
                                         <td class="v-card--hover">{{deteccion.nombreCurso}}</td>
                                         <td class="v-card--hover">{{deteccion.contenidosTM}}</td>
                                         <template v-if="deteccion.periodo === 1">
                                             <td class="v-card--hover">ENERO-JUNIO</td>
                                         </template>
                                         <template v-if="deteccion.periodo === 2">
                                             <td class="v-card--hover">AGOSTO-DICIEMBRE</td>
                                         </template>
                                         <td class="v-card--hover">{{deteccion.objetivoEvento}}</td>
                                         <template v-if="observaciones === true">
                                             <td class="v-card--hover">{{deteccion.observaciones}}</td>
                                         </template>
                                     </tr>
                                     </tbody>
                                 </v-table>
                             </v-card>
                         </v-col>
                     </v-row>
                 </v-container>
             </template>
             <v-col cols="12">
                 <v-btn block prepend-icon="mdi-folder" color="light-blue-darken-1" @click="allRegistros = !allRegistros">
                     Ver todos los registros
                 </v-btn>
             </v-col>
             <template v-if="props.deteccionesAceptadas.length > 0 && allRegistros === true">
                 <v-container class="pt-4 mt-4 pb-12">
                     <v-row justify="center">
                         <v-card >
                             <v-table
                                 fixed-header
                                 height="300px"
                                 hover
                             >
                                 <thead>
                                 <tr>
                                     <th class="text-left">
                                         Dirigido
                                     </th>
                                     <th class="text-left">
                                         Nombre del curso
                                     </th>
                                     <th class="text-left">
                                         Contenido tematicos
                                     </th>
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
                                     v-for="deteccionsi in props.deteccionesAceptadas"
                                     :key="deteccionsi.id" @click="getRow(deteccionsi)"
                                 :class="{ itemSelected: deteccionsi === itemSelected }"

                                 >
                                     <td class="v-card--hover">{{deteccionsi.nameCarrera}}</td>
                                     <td class="v-card--hover">{{deteccionsi.nombreCurso}}</td>
                                     <td class="v-card--hover">{{deteccionsi.contenidosTM}}</td>
                                     <template v-if="deteccionsi.periodo === 1">
                                         <td class="v-card--hover">ENERO-JUNIO</td>
                                     </template>
                                     <template v-if="deteccionsi.periodo === 2">
                                         <td class="v-card--hover">AGOSTO-DICIEMBRE</td>
                                     </template>
                                     <td class="v-card--hover">{{deteccionsi.objetivoEvento}}</td>
                                 </tr>
                                 </tbody>
                             </v-table>
                         </v-card>
                     </v-row>
                 </v-container>
             </template>

             <v-dialog v-model="dialog" fullscreen
                       :scrim="false"
                       transition="dialog-bottom-transition">
                 <v-card>
                     <v-toolbar
                         dark
                         color="blue-grey-lighten-3"

                     >
                         <v-btn
                             icon
                             dark
                             @click="dialog = false"
                             size="x-large"
                         >
                             <v-icon>mdi-close</v-icon>
                         </v-btn>
                         <v-spacer></v-spacer>


                     </v-toolbar>
                     <v-container class="mx-auto">
                         <v-row justify="center">
                                 <v-card-title class="text-center text-h4">
                                     {{itemSelected.nombreCurso}}
                                 </v-card-title>
                                 <v-spacer></v-spacer>
                                 <v-card-text>
                                     <v-container class="pt-4 mt-4">
                                         <v-row align="center" justify="center">
                                             <v-col cols="12">
                                                 <h3 class="">Asignaturas en la que se requiere formación o actualización.</h3>
                                                 <p class="mt-4 text-h5">{{itemSelected.asignaturaFA}}</p>
                                             </v-col>
                                             <v-col cols="12">
                                                 <h3>Contenidos temáticos en que se requiere la formación o actualización.</h3>
                                                 <p class="mt-4 text-h6">{{itemSelected.contenidosTM}}</p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Número de profesores(as) que la requieren.</h4>
                                                 <p class="text-center text-h6">{{itemSelected.numeroProfesores}}</p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Periodo en el que se requiere la formación o actualización (enero-junio o agosto diciembre)</h4>
                                                 <p class="text-center text-h6">
                                                     <template v-if="itemSelected.periodo === 1">
                                                         ENERO-JUNIO
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 2  ">
                                                         AGOSTO-DICIEMBRE
                                                     </template>
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Asignaturas en la que se requiere formación o actualización.</h4>
                                                 <p class="text-center text-h6">{{itemSelected.nameCarrera}}</p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Facilitador(es)</h4>
                                                 <v-card class="">
                                                     <template v-for="facilitador in itemSelected.deteccion_facilitador">
                                                         <p class="text-h6">{{ facilitador.nombre_completo }}</p>
                                                     </template>
                                                 </v-card>
                                             </v-col>
                                         </v-row>
                                         <v-row justify="center" class="mt-2">
                                             <v-col cols="6">
                                                 <h4>Nombre del curso, taller, conferencias, etc.</h4>
                                                 <p class="text-center text-h6">
                                                     <template v-if="itemSelected.periodo === 1">
                                                         TALLER
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 2">
                                                         CURSO
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 3">
                                                         CURSO-TALLER
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 4">
                                                         FORO
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 5">
                                                         SEMINARIO
                                                     </template>
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Tipo de solicitud</h4>
                                                 <p class="text-center text-h6">
                                                     <template v-if="itemSelected.periodo === 1">
                                                         FORMACIÓN DOCENTE
                                                     </template>
                                                     <template v-if="itemSelected.periodo === 2">
                                                         ACTUALIZACIÓN PROFESIONAL
                                                     </template>
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Fecha en que se realizará la actividad o evento: </h4>
                                                 <p class="text-center text-h6">
                                                     {{dateFormat}}
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Fecha en que concluira la actividad o evento: </h4>
                                                 <p class="text-center text-h6">
                                                     {{formatDate}}
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Hora de inicio: </h4>
                                                 <p class="text-center text-h6" >
                                                     {{itemSelected.hora_I}}
                                                 </p>
                                             </v-col>
                                             <v-col cols="6">
                                                 <h4>Hora de finalización: </h4>
                                                 <p class="text-center text-h6">
                                                     {{itemSelected.hora_F}}
                                                 </p>
                                             </v-col>

                                             <v-col cols="12" class="mt-4">
                                                 <h4>Objetivo de la actividad o evento.</h4>
                                                 <p class="text-h6" >
                                                     {{itemSelected.objetivoEvento}}
                                                 </p>
                                             </v-col>
                                             <template v-if="itemSelected.obs === 1">
                                                 <v-col cols="12" class="mt-4">
                                                     <h4 class="ml-0 pl-0">Objetivo de la actividad o evento.</h4>
                                                     <p class="text-h6 text-center">
                                                         {{itemSelected.observaciones}}
                                                     </p>
                                                 </v-col>
                                             </template>
                                         </v-row>
                                     </v-container>
                                 </v-card-text>
                         </v-row>
                     </v-container>
                     <v-card-actions>
                             <v-row justify="end">
                                 <v-col cols="3" class="mr-8">
                                     <Link :href="'/academicos/edit-deteccion' + '/' + itemSelected.id" as="v-btn" type="v-btn">
                                         <v-btn size="x-large" block color="#5865f2" rounded elevation="7">
                                             Editar
                                         </v-btn>
                                     </Link>
                                 </v-col>
                             </v-row>
                     </v-card-actions>
                 </v-card>
             </v-dialog>
         </v-main>
     </v-layout>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import {Link, router, usePage} from "@inertiajs/vue3";
// props
const props = defineProps({
    carer: Array,
    deteccionesall: null,
    deteccionesAceptadas: null,
})
// Variables
const dialog = ref(false);
let dialogPDF = ref(false);
const allRegistros = ref(false);
let itemSelected = ref({});
const menu = ref([
    {
        id: 1,
        name: "Deteccion de Necesidades",
    },
    {
        id: 1,
        name: "PIFAP",
    },
]);
// functions
function getRow(item){
    itemSelected.value = item
    dialog.value = true
}
const formatDate = computed(() => {
    return new Date(itemSelected.value.fecha_F).toLocaleDateString('es-MX');
})
// Computed propierties
const user = computed(() => usePage().props.user[0]);

const observaciones = computed(() => {
    let data = usePage().props.deteccionesall.filter(value => {
        return value.obs
    });

    return data.length !== 0;
});

const dateFormat = computed(() => {
    return new Date(itemSelected.value.fecha_I).toLocaleDateString('es-MX');
});
</script>

<style scoped>
.titulo {
    justify-content: center;
    align-content: center;
    container: initial;
}
. itemSelected {
    background-color: red;
}
.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
    transition: transform .2s ease-in-out;
}
</style>
