<script setup>
import {ref} from 'vue';
import {Link} from '@inertiajs/vue3'
const drawer = ref(true);
const props = defineProps({
    usuario: Array,
})
</script>
<template>
<v-navigation-drawer v-model="drawer" color="light-blue-darken-4">
            <v-list>
                <v-list-item

                >
                                    {{props.usuario[0].email}}
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list color="transparent">
                <Link href="/dashboard" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Inicio"></v-list-item>
                </Link>

                <Link href="/desarrollo/coordinacion/cursos" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                </Link>
                <Link href="/desarrollo/coordinacion/deteccion" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                </Link>
                <template v-if="props.usuario[0].role === 1">
                    <Link href="/desarrollo/parametros" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                    </Link>
                </template>
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
</template>

<style>
</style>