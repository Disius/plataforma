<script setup>
import Main from "./academicos/Main.vue";
import MainDesarrollo from "./desarrollo/MainDesarrollo.vue";
import MainDocente from "./docentes/MainDocente.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

const props = defineProps({
    user: Array,
    notification: Array,
});

</script>
<template>
    <v-app>
        <template v-if="props.user[0].role === 1 || props.user[0].role === 2">
            <MainDesarrollo :n1="notification[0]" :user="props.user"></MainDesarrollo>
        </template>
        <template v-if="props.user[0].role === 3">
            <Main :user="props.user"></Main>
        </template>
        <template v-if="props.user[0].role === 4">
            <MainDocente :user="props.user"></MainDocente>
        </template>
    </v-app>
</template>

<style scoped>

</style>
