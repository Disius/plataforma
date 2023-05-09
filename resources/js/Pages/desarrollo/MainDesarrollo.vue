<template>
    <v-app>
        <v-card
            color="light-blue-darken-1"
            flat
            rounded="0"
            elevation="6"
        >
            <v-toolbar extended color="light-blue-darken-1">
                <v-icon
                    prepend-icon="mdi-arrow-left"
                >

                </v-icon>

                <v-toolbar-title class="text-h5">{{user.email}}</v-toolbar-title>

                <v-spacer></v-spacer>

                <Link as="button" type="button" href="/logout" method="post">
                    <v-btn icon type="button">
                        <v-icon>mdi-logout</v-icon>
                    </v-btn>
                </Link>
            </v-toolbar>
        </v-card>
        <v-container>
            <v-row justify="start" class="mt-5 pt-2">
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
