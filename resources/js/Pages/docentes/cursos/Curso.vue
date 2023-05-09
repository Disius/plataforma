<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import {computed, ref} from "vue";

const user = computed(() => usePage().props.user[0]);

const cards = ref([
    {
        flex: 6,
        name: "Cursos",
        user_rol: 1,
        route: "/docentes/cursos",
    },
    {
        flex: 6,
        name: "",
        user_rol: 2,
        route: "/docentes/cursos",
    },
]);
</script>

<template>
    <v-layout>
        <v-app-bar color="blue-lighten-1">
            <Link href="/dashboard" type="button" as="button">
                <v-btn type="button" size="x-large" icon="mdi-arrow-left">

                </v-btn>
            </Link>

            <v-app-bar-title class="text-center ml-0 text-h5">{{user.email}}</v-app-bar-title>
        </v-app-bar>
    </v-layout>


    <v-container class="mx-auto">
        <v-row justify="center">

        </v-row>
    </v-container>

</template>

<style></style>
