<template>
    <v-app>
        <AcademicosMain></AcademicosMain>
        <v-container>
            <v-row justify="start" class="mt-5 pt-2">
                <Link as="card" type="card" href="/academicos/detecciones" method="get">
                    <v-card elevation="8" width="500" height="400" link type="card">
                        <v-card-title class="text-center">Deteccion de Necesidades</v-card-title>
                        <v-card-text>

                        </v-card-text>
                    </v-card>
                </Link>
            </v-row>
        </v-container>
    </v-app>
</template>

<script setup>
import AcademicosMain from "../Navigation/AcademicosMain.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";

</script>

<style scoped>

</style>
