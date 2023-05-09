<template>
    <v-app>
        <AcademicosMain></AcademicosMain>
        <v-container class="mx-auto">
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
    </v-app>
</template>

<script setup>
import AcademicosMain from "../Navigation/AcademicosMain.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";

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
]);
</script>

<style scoped>

</style>
