<template>
    <v-app>
        <template v-if="user.role === 3">
            <Main></Main>
        </template>
    </v-app>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import Main from "./academicos/Main.vue";



const user = computed(() => usePage().props.user[0])
</script>

<style scoped>

</style>
