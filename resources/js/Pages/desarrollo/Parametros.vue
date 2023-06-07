<script setup>
    import Carrera from "./parametros_components/Carrera.vue";
    import {Link} from "@inertiajs/vue3";


    const props = defineProps({
        user: Array,
        carreras: Array,
        departamento: Array,
    })
</script>

<template>
    <v-layout>
        <v-app-bar
            extended
            color="blue-grey-lighten-3"
            absolute
        >
            <Link href="/dashboard" as="button" type="button">
                <v-btn icon class="ml-8" size="x-large">
                    <v-icon icon="mdi-arrow-left" style=""></v-icon>
                </v-btn>
            </Link>

            <v-app-bar-title class="text-h5 text-center">{{props.user[0].email}}</v-app-bar-title>

        </v-app-bar>
        <v-main>
            <v-container fluid>
                <v-row justify="center">
                    <Carrera :carrera="carreras" :departamento="departamento"/>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>

<style scoped>

</style>
