<template>
    <v-layout>
        <v-app-bar
            extended
            color="blue-grey-lighten-3"
            absolute
        >
            <v-img class="d-flex justify-center align-center mt-10"
                   width="200"
                   heigth="200"
                   src="http://plataforma-docente.test/storage/Tec-Tuxtla_Logo.png"
            >
            </v-img>
            <v-app-bar-title class="text-center text-xl-center"></v-app-bar-title>
            <v-img class="d-flex justify-end  mt-10 mr-4"
                   width="200"
                   heigth="400"
                   src="http://plataforma-docente.test/storage/tecnm.jpg"
            >
            </v-img>
        </v-app-bar>
        <v-main>
            <v-container class="mt-3 pt-10">
                <v-row justify="center" class="" >
                    <v-col
                        v-for="card in nameCards"
                        :key="card.name"
                        :cols="card.flex"
                        class="d-flex justify-center align-center"
                    >
                        <Link
                            :href="card.route"
                            as="card"
                            type="card"
                            :data="{ role: card.user_rol }"
                        >
                            <v-hover>
                                <template v-slot:default="{ isHovering, props }">
                                    <v-card
                                        v-bind="props"
                                        :color="isHovering ? 'light-blue-darken-4' : undefined"
                                        height="200"
                                        width="500"
                                        class="d-flex justify-center align-center"
                                        link
                                        type="card"
                                    >
                                        <span class="text-h6 text-center">{{card.name}}</span>
                                    </v-card>
                                </template>
                            </v-hover>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>

</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import MainNav from "./navigation/MainNav.vue";

const length = ref(3);
const window = ref(0);

const nameCards = ref([
    {
        flex: 6,
        name: "Departamento de Desarrollo Académico",
        user_rol: 1,
        route: "/login",
    },
    {
        flex: 5,
        name: "Coordinación de Formación docente y Actualización profesional",
        user_rol: 2,
        route: "/login",
    },
    { flex: 6, name: "Jefes Academicos", user_rol: 3, route: "/login" },
    { flex: 5, name: "Docentes", user_rol: 4, route: "/login" },
]);
</script>

<style scoped>

</style>
