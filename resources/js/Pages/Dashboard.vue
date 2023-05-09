<template>
    <v-app>
        <template v-if="user.role === 2">
            <MainDesarrollo></MainDesarrollo>
        </template>
        <template v-if="user.role === 3">
            <Main></Main>
        </template>
        <template v-if="user.role === 4">
            <MainDocente></MainDocente>
        </template>
    </v-app>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import Main from "./academicos/Main.vue";
import MainDesarrollo from "./desarrollo/MainDesarrollo.vue";
import MainDocente from "./docentes/MainDocente.vue";


const user = computed(() => usePage().props.user[0])
</script>

<style scoped>

</style>
