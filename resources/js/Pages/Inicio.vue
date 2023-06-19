<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import DocentesHeader from "./docentes/header/DocentesHeader.vue";

const length = ref(3);
const window = ref(0);

const nameCards = ref([
    { flex: 5, name: "Departamento de Desarrollo Académico", user_rol: 1, route: "/login"},
    { flex: 5, name: "Coordinación de Formación docente y Actualización profesional", user_rol: 2, route: "/login",},
    { flex: 5, name: "Jefes Academicos", user_rol: 3, route: "/login" },
    { flex: 5, name: "Docentes", user_rol: 4, route: "/login" },
]);
</script>
<template>
    <v-layout>
        
            <v-container class="mt-16 pt-16">
                <v-row justify="center" class="" >
                    <v-col
                        v-for="card in nameCards"
                        :key="card.name"
                        :cols="card.flex"
                        class="d-flex justify-center align-center"
                    >
                        <Link
                            :href="card.route"
                            as="card"
                            type="card"
                            :data="{ role: card.user_rol }"
                        >
                            <v-hover>
                                <template v-slot:default="{ isHovering, props }">
                                    <v-card
                                        v-bind="props"
                                        :color="isHovering ? 'light-blue-darken-4' : undefined"
                                        height="250"
                                        width="600"
                                        class="d-flex justify-center align-center"
                                        link
                                        type="card"
                                        elevation="10"
                                    >
                                        <span class="text-h6 text-center">{{card.name}}</span>
                                    </v-card>
                                </template>
                            </v-hover>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>
    </v-layout>

</template>



<style scoped>

</style>
