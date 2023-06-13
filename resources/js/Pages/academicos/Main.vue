<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import AcademicsHeader from "./AuthHeader/AcademicsHeader.vue";
const props = defineProps({
    user: Array,
});
</script>
<template>
    <v-layout>
        <AcademicsHeader :usuario="props.user"/>

        <v-main>

        </v-main>
    </v-layout>
</template>


<style scoped>

</style>
