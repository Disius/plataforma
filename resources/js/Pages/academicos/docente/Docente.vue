<template>
    <v-layout class="" style="height: 50px">
        <v-app-bar color="blue-lighten-1">
            <Link href="/dashboard" type="button" as="button">
                <v-btn type="button" size="x-large" icon="mdi-arrow-left">

                </v-btn>
            </Link>

            <v-app-bar-title class="text-center ml-0 text-h5">{{user.email}}</v-app-bar-title>
        </v-app-bar>
    </v-layout>

    <v-container class="mt-4 pt-4">
        <v-row justify="center">
            <v-card elevation="8" width="2000">
                <v-card-title>
                    <v-row justify="center">
                        <v-col cols="2">
                            Buscar por nombre:
                        </v-col>
                        <v-col cols="4">
                            <v-text-field
                            variant="solo"
                            v-model="filtroNombre"
                            >

                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-table fixed-header height="500px" hover>
                    <thead>
                    <tr>
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Apellido Paterno</th>
                        <th class="text-left">Apellido Materno</th>
                        <th class="text-left">
                            Email
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="docente in docentes"
                        @click="getRow(docente)"
                        :key="docente.id"
                        :class="{
                                    itemSelected: docente === itemSelected,
                                }"
                    >
                        <td>{{docente.nombre}}</td>
                        <td>{{docente.apellidoPat}}</td>
                        <td>{{docente.apellidoMat}}</td>
                        <td>{{docente.email}}</td>
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
                color="light-blue-darken-1"
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

                    </v-sheet>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<script setup>
import {usePage, Link} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const user = computed(() => usePage().props.user[0]);
let itemSelected = ref({});
const dialog = ref(false);
let docentes = computed(() => usePage().props.docentes);
let DocentesBase = computed(() => usePage().props.docentesBase);
let filtroNombre = ref("");

console.log(DocentesBase.value)
function getRow(item) {
    itemSelected.value = item;
    dialog.value = true;
}
</script>

<style scoped>

</style>
