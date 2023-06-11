<script setup>
import {computed, ref} from "vue";
import {usePage, Link} from "@inertiajs/vue3";
import Nav from "../../../AuthHeader/Nav.vue";

const props = defineProps({
    user: Array,
})
let itemSelected = ref({});
let cursos = computed(() => usePage().props.cursos);
const dialog = ref(false);

const form = ref();
const dateFormat = computed(() => {
    return new Date(itemSelected.value.fecha_I).toLocaleDateString("es-MX");
});
const formatDate = computed(() => {
    return new Date(itemSelected.value.fecha_F).toLocaleDateString("es-MX");
});
function getRow(item) {
    itemSelected.value = item;
    dialog.value = true;
}
</script>

<template>
    <v-layout>
        <v-navigation-drawer v-model="drawer">
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

                    <Link href="/desarrollo/coordinacion/cursos" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                    </Link>
                    <Link href="/desarrollo/coordinacion/deteccion" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                    </Link>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <Link href="/logout" as="v-btn" method="post">
                        <v-btn block>
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
            <v-container class="mt-4 pt-4">
                <v-row justify="center">
                    <v-card elevation="8">
                        <v-table fixed-header height="500px" hover>
                            <thead>
                            <tr>
                                <th class="text-left">Nombre del curso</th>
                                <th class="text-left">Dirigido</th>
                                <th class="text-left">Tipo de Curso</th>
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
                                v-for="curso in cursos"
                                @click="getRow(curso)"
                                :key="curso.id"
                                :class="{
                                    itemSelected: curso === itemSelected,
                                }"
                            >
                                <td class="v-card--hover">
                                    {{ curso.nameCurso }}
                                </td>
                                <td class="v-card--hover">
                                    {{ curso.nombreCarrera }}
                                </td>
                                <template v-if="curso.tipo_curso === 1">
                                    <td class="v-card--hover">
                                        FORMACIÓN DOCENTE
                                    </td>
                                </template>
                                <template v-if="curso.tipo_curso === 2">
                                    <td class="v-card--hover">
                                        ACTUALIZACIÓN PROFESIONAL
                                    </td>
                                </template>
                                <template v-if="curso.periodo === 1">
                                    <td class="v-card--hover">ENERO-JUNIO</td>
                                </template>
                                <template v-if="curso.periodo === 2">
                                    <td class="v-card--hover">
                                        AGOSTO-DICIEMBRE
                                    </td>
                                </template>
                                <td class="v-card--hover">
                                    {{ curso.objetivo }}
                                </td>
                            </tr>
                            </tbody>
                        </v-table>
                    </v-card>
                </v-row>
            </v-container>
            <v-dialog
                v-model="dialog"
                fullscreen
                :scrim="false"
                transition="dialog-bottom-transition"
            >
                <v-card class="mx-auto">
                    <v-toolbar
                        dark
                        color="blue-grey-lighten-3"
                        prominent
                        elevation="7"
                    >
                        <v-btn icon dark @click="dialog = false" size="x-large">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>

                        <!--                    <v-toolbar-title>Settings</v-toolbar-title>-->
                        <v-spacer></v-spacer>
                        <v-row justify="center">

                        </v-row>
                    </v-toolbar>
                    <v-container class="mx-auto">
                        <v-row justify="center">
                            <v-sheet
                                :height="650"
                                :width="3000"
                                :elevation="8"
                                class="mt-3 pt-4"
                            >
                                <v-card-title class="text-center text-h5">
                                    {{ itemSelected.nameCurso }}
                                </v-card-title>
                                <v-spacer></v-spacer>
                                <v-card-text>
                                    <v-container class="pt-4 mt-4">
                                        <v-row align="center" justify="center">
                                            <v-col cols="6">
                                                <h4>
                                                    Periodo en el que se requiere la
                                                    formación o actualización
                                                    (enero-junio o agosto diciembre)
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        1
                                                    "
                                                    >
                                                        ENERO-JUNIO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.periodo ===
                                                        2
                                                    "
                                                    >
                                                        AGOSTO-DICIEMBRE
                                                    </template>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                        <v-row justify="center" class="mt-2">
                                            <v-col cols="6">
                                                <h4>
                                                    Tipo de actividad
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_actividad ===
                                                        1
                                                    "
                                                    >
                                                        TALLER
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_actividad ===
                                                        2
                                                    "
                                                    >
                                                        CURSO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_actividad ===
                                                        3
                                                    "
                                                    >
                                                        CURSO-TALLER
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_actividad ===
                                                        4
                                                    "
                                                    >
                                                        FORO
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_actividad ===
                                                        5
                                                    "
                                                    >
                                                        SEMINARIO
                                                    </template>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Tipo de Curso</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_curso ===
                                                        1
                                                    "
                                                    >
                                                        FORMACIÓN DOCENTE
                                                    </template>
                                                    <template
                                                        v-if="
                                                        itemSelected.tipo_curso ===
                                                        2
                                                    "
                                                    >
                                                        ACTUALIZACIÓN PROFESIONAL
                                                    </template>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que se realizará la
                                                    actividad o evento:
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ dateFormat }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>
                                                    Fecha en que concluira la
                                                    actividad o evento:
                                                </h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ formatDate }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de inicio:</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_I }}
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6">
                                                <h4>Hora de finalización:</h4>
                                                <v-card
                                                    class="text-center text-h6"
                                                    elevation="0"
                                                >
                                                    {{ itemSelected.hora_F }}
                                                </v-card>
                                            </v-col>

                                            <v-col cols="12" class="mt-4">
                                                <h4>
                                                    Objetivo de la actividad o
                                                    evento.
                                                </h4>
                                                <v-card
                                                    class="text-h6 ml-3"
                                                    elevation="0"
                                                >
                                                    {{
                                                        itemSelected.objetivo
                                                    }}
                                                </v-card>
                                            </v-col>

                                            <v-col cols="6" class="mt-5 pt-5">
                                                <v-btn block color="light-blue-darken-1">
                                                    Docentes inscritos
                                                </v-btn>
                                            </v-col>
<!--                                            <v-col cols="6" class="mt-5 pt-5">-->
<!--                                                <v-btn block color="deep-orange-accent-3">-->
<!--                                                    Inscribir docentes-->
<!--                                                </v-btn>-->
<!--                                            </v-col>-->

                                        </v-row>
                                    </v-container>
                                </v-card-text>
                            </v-sheet>
                        </v-row>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-main>
    </v-layout>
</template>

