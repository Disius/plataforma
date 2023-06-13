<script setup>
//Imports
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import DesarrolloHeader from "./header/DesarrolloHeader.vue";

//variables
const props = defineProps({
    user: Array
});
const drawer = ref(true);
const cards = ref([
    {
        flex: 6,
        name: "Cursos",
        route: "/desarrollo/coordinacion/cursos",
        disable: false,
    },
    {
        flex: 6,
        name: "Deteccion de Necesidades",
        route: "/desarrollo/coordinacion/deteccion",
        disable: false,
    },
    {
        flex: 6,
        name: "Mis Datos",
        route: "/docentes/mis-datos",
        disable: false,
    },
]);
</script>

<template>
    <v-layout>
        <DesarrolloHeader :usuario="props.user"/>

        <v-main>

        </v-main>
    </v-layout>
</template>


<style scoped>

</style>
