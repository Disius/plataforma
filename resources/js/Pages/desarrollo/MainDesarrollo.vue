<template>
    <v-app>
        <v-app-bar color="blue-lighten-1">
            <v-app-bar-title class="text-h5">{{user.email}}</v-app-bar-title>
            <Link as="button" type="button" href="/logout" method="post">
                <v-btn icon="mdi-logout" type="button" size="x-large">
                </v-btn>
            </Link>
        </v-app-bar>
        <v-container class="mt-12 pt-12">
            <v-row justify="start" class="">
                <v-col>
                    <Link as="card" type="card" href="/desarrollo/coordinacion/deteccion" method="get">
                        <v-card elevation="8" width="500" height="400" link type="card">
                            <v-card-title class="text-center text-h5">DETECCION DE NECESIDADES</v-card-title>
                            <v-card-text>

                            </v-card-text>
                        </v-card>
                    </Link>
                </v-col>
                <v-col>
                    <Link as="card" type="card" href="/desarrollo/coordinacion/cursos" method="get">
                        <v-card elevation="8" link class="" height="400" width="500">
                            <v-card-title class="text-center text-h5">CURSOS</v-card-title>
                        </v-card>
                    </Link>
                </v-col>
            </v-row>
        </v-container>

    </v-app>
</template>

<script setup>
//Imports
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

//variables
const user = computed(() => usePage().props.user[0]);
console.log(user.value)
</script>

<style scoped>

</style>
