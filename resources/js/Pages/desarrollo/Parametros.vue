<script setup>
    import DesarrolloHeader from "./header/DesarrolloHeader.vue";
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
        <DesarrolloHeader :usuario="props.user"/>
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
