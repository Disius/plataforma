<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import Nav from "../AuthHeader/Nav.vue";
const props = defineProps({
    user: Array,
});
const drawer = ref(true);
const cards = ref([
    {
        flex: 6,
        name: "Deteccion de Necesidades",
        route: "/academicos/detecciones",
    },
    {
        flex: 6,
        name: "Cursos",
        route: "/academicos/cursos",
    },
    {
        flex: 6,
        name: "Docentes",
        route: "/academicos/docentes",
    },
    {
        flex: 6,
        name: "Mis Datos",
        route: "/docentes/mis-datos",
        disable: false,
    }
]);
</script>
<template>
    <v-layout>
        <v-navigation-drawer v-model="drawer" color="light-blue-darken-4">
            <v-list>
                <v-list-item

                >
                                    {{props.user[0].email}}
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list color="transparent">
                <Link href="/dashboard" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Inicio"></v-list-item>
                </Link>

                <Link href="/academicos/cursos" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                </Link>
                <Link href="/academicos/detecciones" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                </Link>

                <Link href="/docentes/mis-datos" as="v-list-item">
                     <v-list-item link prepend-icon="" title="Mi información"></v-list-item>
                </Link>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <Link href="/logout" as="v-btn" method="post">
                        <v-btn block color="light-blue-darken-1">
                            Logout
                        </v-btn>
                    </Link>
                </div>
            </template>
        </v-navigation-drawer>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-app-bar class="">
            <v-icon size="x-large" class="ml-4" @click="drawer = !drawer">mdi-menu</v-icon>
        </v-app-bar>

        <v-main>

        </v-main>
    </v-layout>
</template>


<style scoped>

</style>
