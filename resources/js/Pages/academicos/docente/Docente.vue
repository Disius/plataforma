<script setup>
import {usePage, Link} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import AcademicsHeader from "../AuthHeader/AcademicsHeader.vue";

const props = defineProps({
    user: Array
});
const user = computed(() => usePage().props.user[0]);
let itemSelected = ref({});
const dialog = ref(false);
let docentes = computed(() => usePage().props.docentes);
let DocentesBase = computed(() => usePage().props.docentesBase);
let filtroNombre = ref("");

console.log(DocentesBase.value)
function getRow(item) {
    itemSelected.value = item;
    dialog.value = true;
}
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
