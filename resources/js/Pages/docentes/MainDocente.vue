<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import DocentesHeader from "./header/DocentesHeader.vue";

const props = defineProps({
    user: Array
});
</script>
<template>
    <v-layout>
        <DocentesHeader :usuario="props.user"/>

        <v-main>
            
        </v-main>
    </v-layout>
</template>


<style scoped></style>
