<template>
    <v-layout>
        <v-app-bar
            extended
            color="blue-grey-lighten-3"
            absolute
        >
            <v-img class="d-flex justify-center align-center mt-10"
                   width="200"
                   heigth="200"
                   src="http://plataforma-docente.test/storage/Tec-Tuxtla_Logo.png"
            >
            </v-img>
            <v-app-bar-title class="text-center text-xl-center"></v-app-bar-title>
            <v-img class="d-flex justify-end  mt-10 mr-4"
                   width="200"
                   heigth="400"
                   src="http://plataforma-docente.test/storage/tecnm.jpg"
            >
            </v-img>
        </v-app-bar>
        <v-main>
            <v-container class="pt-6 mt-5">
                <v-row justify="center">
                    <v-card width="600" height="100" elevation="9">
                        <v-card-text>
                            <v-row justify="center">
                                <v-col align-self="center" cols="12">
                                    
                                </v-col>
                                <v-col cols="5" align-self="end">
                                    <v-btn>

                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>

<script setup>
import { computed, ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import MainNav from "../navigation/MainNav.vue";

let docentes = computed(() => usePage().props.docentes);
const role = computed(() => usePage().props.role);
console.log(role.value)
const form = ref();
const formRegistro = useForm({
    id_docente: null,
    email: "",
    password: "",
    roleUser: role.value,
    name: "",
    departamento_id: null,
});

</script>

<style scoped>
label {
    font-weight: bold;
    display: block;
    width: 100px;
    float: top;
    text-align: center;
}
</style>
