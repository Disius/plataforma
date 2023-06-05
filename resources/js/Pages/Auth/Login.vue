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
            <v-container class="mt-5 pt-6">
                <v-row justify="center"  align="center" class="">
                    <v-card width="800" height="900" elevation="0" rounded >
                        <!--                    <v-card-title class="bg-blue-lighten-2"></v-card-title>-->
                        <v-card-text>

                            <template v-for="error in errors" :key="error">
                                <v-row justify="center">
                                    <v-col cols="12">
                                        <v-alert
                                            color="error"
                                            icon="$error"
                                            title="Error"
                                            v-model="timeErrors"
                                        >
                                            {{error}}

                                        </v-alert>
                                    </v-col>
                                </v-row>
                            </template>
                            <v-form fast-fail @submit.prevent="form.post('/login')">
                                <v-row justify="center" class="mt-5">
                                    <v-col cols="6" class="mt-8">
                                        <v-text-field label="Correo Institucional" variant="solo" v-model="form.email" clearable></v-text-field>
                                    </v-col>
                                    <v-col cols="6" class="mt-8">
                                        <v-text-field type="password" label="Contraseña" variant="solo" v-model="form.password" clearable></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row justify="end">
                                    <v-col cols="4">
                                        <v-btn prepend-icon="mdi-login" size="x-large" type="submit">
                                            Iniciar Sesión
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card-text>
                        <v-spacer></v-spacer>
                        <v-row justify="center" class="mt-16">
                            <v-sheet :width="800" :height="100" elevation="3" color="blue-darken-1">
                                <v-row justify="center" class="mt-2">
                                    <v-col cols="5" align-self="center" class="ml-1 pl-16">
                                        <span class="text-center text-h6">¿Aun no estas registrado?</span>
                                    </v-col>
                                    <v-col cols="5" align-self="center" class="ml-16 pl-12">
                                        <Link as="button" type="button" href="/register" :data="{role: props.role}">
                                            <v-btn prepend-icon="mdi-account-plus-outline" size="x-large" type="button">
                                                Registrarse
                                            </v-btn>
                                        </Link>
                                    </v-col>
                                </v-row>
                            </v-sheet>
                        </v-row>
                    </v-card>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>

</template>

<script setup>
import {useForm, Link, usePage} from "@inertiajs/vue3";
import {computed, onMounted, ref} from "vue";
import MainNav from "../navigation/MainNav.vue";

const props = defineProps({
    role: null,
})
let timeErrors = ref(true);
const form = useForm({
    email: null,
    password: null,
});
const errors = computed(() => usePage().props.errors)

onMounted(() => {
    setTimeout(() => {
        timeErrors.value = false
    }, 10000)
})
</script>

<style scoped>

</style>
