<script setup>
import {computed, onMounted, ref} from "vue";
import {Link, router, usePage} from "@inertiajs/vue3";
// props
const props = defineProps({
    carer: Array,
    detecciones: Array,
    user: Array
})
// Variables
const drawer = ref(true);
const dialog = ref(false);
let dialogPDF = ref(false);
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
    let data = usePage().props.detecciones.filter(value => {
        return value.obs
    });

    return data.length !== 0;
});

const dateFormat = computed(() => {
    return new Date(itemSelected.value.fecha_I).toLocaleDateString('es-MX');
});
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
             <v-container class="mt-2 pt-2">
                 <v-row justify="start" class="md-4">
                     <v-col cols="3">
                         <v-menu>
                             <template v-slot:activator="{ props }">
                                 <v-btn v-bind="props" size="x-large" block>
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
                     <v-col cols="9">
                         <Link href="/academicos/crear-deteccion" as="v-btn">
                             <v-btn block height="52px">
                                 Crear deteccion de necesidades
                             </v-btn>
                         </Link>
                     </v-col>
                 </v-row>
             </v-container>
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
                                         <th>Estado</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     <tr
                                         v-for="deteccion in props.detecciones" @click="getRow(deteccion)"
                                         :key="deteccion.id" :class="{ itemSelected: deteccion === itemSelected }"

                                     >

                                         <td class="v-card--hover">{{deteccion.nombreCurso}}</td>
                                         <td class="v-card--hover">{{deteccion.contenidosTM}}</td>
                                         <template v-if="deteccion.periodo === 1">
                                             <td class="v-card--hover">ENERO-JUNIO</td>
                                         </template>
                                         <template v-if="deteccion.periodo === 2">
                                             <td class="v-card--hover">AGOSTO-DICIEMBRE</td>
                                         </template>
                                         <td class="v-card--hover">{{deteccion.objetivoEvento}}</td>
                                    
                                     </tr>
                                     </tbody>
                                 </v-table>
                             </v-card>
                         </v-col>
                     </v-row>
                 </v-container>
             <v-col cols="12">
                 <Link href="/academicos/detecciones/todas" as="v-btn">
                     <v-btn block prepend-icon="mdi-folder" color="light-blue-darken-1">
                         Ver todos los registros
                     </v-btn>
                 </Link>
             </v-col>
         </v-main>
         <v-dialog v-model="dialog" fullscreen
                   :scrim="false"
                   transition="dialog-bottom-transition">
             <v-card>
                 <v-toolbar
                     dark
                     color="light-blue-darken-4"

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
                     <Link :href="'/academicos/edit-deteccion' + '/' + itemSelected.id" as="v-btn" type="v-btn">
                                 <v-btn block class="mr-16" size="x-large">
                                     Editar
                                 </v-btn>
                    </Link>

                 </v-toolbar>
                 <v-container class="mx-auto">
                     <v-row justify="center">
                         <v-spacer></v-spacer>
                         <v-card width="1700" class="pa-5 ma-5">
                            <v-card-title class="text-center text-h4">
                                {{itemSelected.nombreCurso}}
                            </v-card-title>
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
                                         <h4>Modalidad.</h4>
                                         <p class="text-center text-h6">
                                             <template v-if="itemSelected.modalidad === 1">
                                                 Virtual
                                             </template>
                                             <template v-if="itemSelected.modalidad === 2">
                                                 Presencial
                                             </template>
                                             <template v-if="itemSelected.modalidad === 3">
                                                 Hibrído
                                             </template>
                                         </p>
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
                                     <v-col cols="12">
                                         <h4>Facilitador(es)</h4>
                                         <v-card class="">
                                             <template v-for="facilitador in itemSelected.deteccion_facilitador">
                                                 <p class="text-h6">{{ facilitador.nombre_completo }}</p>
                                             </template>
                                         </v-card>
                                     </v-col>
                                     <v-col cols="12">
                                         <h4>Facilitador externo</h4>
                                             <p class="text-h6 ml-4">{{ itemSelected.facilitador_externo }}</p>
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
                         </v-card>
                     </v-row>
                 </v-container>
             </v-card>
         </v-dialog>
     </v-layout>
</template>

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
