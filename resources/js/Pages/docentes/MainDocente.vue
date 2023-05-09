<template>
        <v-app-bar color="blue-lighten-1">
            <v-app-bar-title class="text-h5">{{user.email}}</v-app-bar-title>
            <Link as="button" type="button" href="/logout" method="post">
                <v-btn icon="mdi-logout" type="button" size="x-large">
                </v-btn>
            </Link>
        </v-app-bar>


    <v-container class="mx-auto mt-16">
        <v-row justify="center" class="mt-10">
            <v-col v-for="card in cards" :key="card.id" :cols="card.flex">
                <Link :href="card.route" as="card" type="card">
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
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const user = computed(() => usePage().props.user[0]);

const cards = ref([
    {
        flex: 6,
        name: "Cursos",
        route: "/docentes/cursos",
    },
    {
        flex: 6,
        name: "Mis Cursos",
        route: "/docentes/cursos",
    },
    {
        flex: 6,
        name: "Mis Datos",
        route: "/docentes/mis-datos",
    },
]);
</script>

<style scoped></style>
