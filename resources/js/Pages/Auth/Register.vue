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
            <v-form ref="form" @submit.prevent="submit">
                    <v-container class="mt-3 pt-2">
                        <v-row justify="center">
                            <v-card width="700" height="400" elevation="0">
                                <v-card-text>
                                    <v-row justify="center">
                                        <v-col cols="10">
                                            <v-text-field label="Correo Institucional" variant="solo" v-model="formRegistro.email" clearable :rules="emailRules">

                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="10">
                                            <v-text-field :rules="passwordRule" label="Contraseña" variant="solo" clearable type="password" v-model="formRegistro.password">

                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="10">
                                            <v-select :items="departamento" item-title="nameDepartamento" item-value="id" label="Departamento Adscrito" variant="solo" clearable v-model="formRegistro.departamento_id">

                                            </v-select>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                                    <v-row justify="end" class="mr-4 pr-12">
                                        <v-col cols="5" align-self="end">
                                            <v-btn size="x-large" block append-icon="mdi-login-variant" type="submit" color="blue-lighten-1">
                                                Ingresar
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                            </v-card>
                        </v-row>
                    </v-container>
            </v-form>
        </v-main>
    </v-layout>
</template>

<script setup>
import { computed, ref } from "vue";
import {router, useForm, usePage} from "@inertiajs/vue3";

const props = defineProps({
    role: null,
    departamento: null,
    docente: null,
})
const form = ref();
const formRegistro = useForm({
    id_docente: null,
    email: "",
    password: "",
    roleUser: props.role,
    name: "",
    departamento_id: null,
});
const passwordRule = [
    value => {
        if (value?.length >= 8) return true

        return 'LA CONTRASEÑA DEBE TENER AL MENOS 8 CARACTERES'
    },
]
const emailRules = [
    value => {
        if (/^[^@]+@\w+(\.\w+)+\w$/.test(value)) return true

        return 'El email no es valido'
    }
]
function submit(){
    formRegistro.post('register');
}
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
