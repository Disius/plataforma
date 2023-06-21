<script setup>
//Imports
import {Link} from "@inertiajs/vue3";
import {computed, onMounted} from "vue";
import {usePage} from "@inertiajs/vue3";
import axios from "axios";
import {ref} from "vue";
import DesarrolloHeader from "./header/DesarrolloHeader.vue";

//variables
const props = defineProps({
    user: Array,
    n1: Array
});
// let notifications = ref(Array);
const drawer = ref(true);
// onMounted(() => {
//     axios.get('/notifications').then(res => {
//         notifications.value = res.data
//     }).catch(error => {
//         console.log(error)
//     })
// })
</script>

<template>
    <v-layout>
        <DesarrolloHeader :n2="props.n1" :usuario="props.user"/>

        <v-main>

        </v-main>
    </v-layout>
</template>


<style scoped>

</style>
