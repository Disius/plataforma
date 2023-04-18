<template>
    <v-app>
            <NavMain></NavMain>
            <v-container class="mx-auto mt-12">
                <v-card class="mx-auto mt-8" max-width="2000" max-height="2000" elevation="8" color="blue">
                    <v-container>
                        <v-row justify="center" align="center" dense>
                            <v-col
                                v-for="card in nameCards"
                                :key="card.name"
                                :cols="card.flex"
                            >
                                <Link :href="card.route" as="card" type="card" :data="{role: card.user_rol}">
                                    <v-card elevation="8" height="200px" class="d-flex justify-center align-center" link type="card">
                                        <span class="text-h5">{{card.name}}</span>
                                    </v-card>
                                </Link>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-container>
    </v-app>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import {ref} from "vue";
import NavMain from "./Navigation/NavMain.vue";

const length = ref(3);
const window = ref(0);

const nameCards = ref([
    {flex: 6, name: "Jefe del Departamento de Desarrollo Académico", user_rol: 1, route: '/login'},
    {flex: 6, name: "Coordinación de Formación docente y Actualización profesional", user_rol: 2, route: '/login'},
    {flex: 6, name: "Jefes Academicos", user_rol: 3, route: '/login'},
    {flex: 6, name: "Docentes", user_rol: 4, route: '/login'},
    ]);
</script>

<style scoped>

</style>
