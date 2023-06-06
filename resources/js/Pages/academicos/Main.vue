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
            <v-app-bar-title class="text-h5">{{user.email}}</v-app-bar-title>
            <v-img class="d-flex justify-end  mt-10"
                   width="200"
                   heigth="400"
                   src="http://plataforma-docente.test/storage/tecnm.jpg"
            >
            </v-img>
            <Link as="button" type="button" href="/logout" method="post">
                <v-btn icon="mdi-logout" type="button" size="x-large">
                </v-btn>
            </Link>
        </v-app-bar>
        <v-main>
            <v-container class="mt-5 pt-5">
                <v-row justify="center" class="">
                    <v-col
                        v-for="card in cards" :key="card.id" :cols="card.flex"
                    >
                        <Link :href="card.route" type="card" as="card">
                            <v-card
                                elevation="8"
                                height="200px"
                                class="d-flex justify-center align-center"
                                link
                                type="card"
                            >
                                <span class="text-h5">{{ card.name }}</span>
                            </v-card>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>

<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";


const user = computed(() => usePage().props.user[0])
const cards = ref([
    {
        flex: 6,
        name: "Deteccion de Necesidades",
        route: "/academicos/detecciones",
    },
    {
        flex: 6,
        name: "Cursos",
        route: "/academicos/cursos",
    },
    {
        flex: 6,
        name: "Docentes",
        route: "/academicos/docentes",
    },
    {
        flex: 6,
        name: "Mis Datos",
        route: "/docentes/mis-datos",
        disable: false,
    }
]);
</script>

<style scoped>

</style>
