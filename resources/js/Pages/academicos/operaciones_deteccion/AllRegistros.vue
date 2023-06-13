<script setup>
import {ref} from "vue";
import { Link } from "@inertiajs/vue3";
import AcademicsHeader from "../AuthHeader/AcademicsHeader.vue";
const props = defineProps({
    detecciones: Array,
    user: Array
});
const drawer = ref(true);
let itemSelected = ref({});
const dialog = ref(false);


//permite obtener los datos que estan en el row de la tabla y almacenarlos en una variable, en este caso "itemSelected". El value al ser un proxy object
function getRow(item){
    itemSelected.value = item
    dialog.value = true
}
</script>



<template>
<v-layout>
    <AcademicsHeader :usuario="props.user"/>
    <v-main>
        <v-container class="mt-5 pt-5">
            <v-row justify="center">
                <v-card elevation="7">
                    <v-table
                        fixed-header
                        height="500px"
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
                            <th class="text-left">
                                    Observaciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="deteccion in props.detecciones" @click="getRow(deteccion)"
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
                            <template v-if="deteccion.obs === 1">
                                <td>{{ deteccion.observaciones }}</td>
                            </template>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card>
            </v-row>
        </v-container>

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

                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</v-layout>
</template>


<style scoped>
. itemSelected {
    background-color: red;
}
</style>
