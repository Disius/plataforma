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
            <Link as="button" type="button" href="/dashboard">
                <v-btn icon="mdi-arrow-left" type="button" size="x-large">
                </v-btn>
            </Link>
            <v-app-bar-title class="text-h5">{{user.email}}</v-app-bar-title>
            <v-img class="d-flex justify-end  mt-10 mr-4"
                   width="200"
                   heigth="400"
                   src="http://plataforma-docente.test/storage/tecnm.jpg"
            >
            </v-img>
        </v-app-bar>
        <v-main>
            <v-container class="mx-auto">
                <v-row justify="center" class="mt-4">
                    <v-sheet :width="1100" >
                        <h1 class="text-center">Información personal</h1>
                        <v-divider></v-divider>
                        <v-form @submit.prevent="submit">
                            <v-container class="mx-auto">
                                <v-row justify="center">
                                    <v-col align-self="center" cols="12">
                                        <v-alert
                                            type="info"
                                            title="Atención"
                                            text='Nombres como apellidos deben comenzar con MAYÚSCULAS y seguido de MINUSCULAS'
                                            variant="tonal"
                                        ></v-alert>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>NOMBRE(S):</p>
                                        <template v-if="docente != null">
                                            <v-text-field
                                                label=""
                                                v-model="docente.nombre"
                                            >
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field label="" v-model="formDocente.nombre"> </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>APELLIDO PATERNO:</p>
                                        <template v-if="docente != null">
                                            <v-text-field
                                                label=""
                                                v-model="docente.apellidoPat"
                                            >
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field label="" v-model="formDocente.apellidoPat"> </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>APELLIDO MATERNO:</p>
                                        <template v-if="docente != null">
                                            <v-text-field
                                                label=""
                                                v-model="docente.apellidoMat"
                                            >
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field
                                                label=""
                                                v-model="formDocente.apellidoMat"
                                            >
                                            </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>SEXO:</p>
                                        <template v-if="docente != null">
                                            <v-select v-model="docente.sexo" :items="sex" item-title="text" item-value="value">
                                            </v-select>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-select v-model="formDocente.sexo" :items="sex" item-title="text" item-value="value">

                                            </v-select>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>CURP:</p>
                                        <template v-if="docente != null">
                                            <v-text-field v-model="docente.curp">
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field v-model="formDocente.curp">
                                            </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>RFC:</p>
                                        <template v-if="docente != null">
                                            <v-text-field v-model="docente.rfc">
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field v-model="formDocente.rfc">
                                            </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>CORREO INSTITUCIONAL:</p>
                                        <template v-if="docente != null">
                                            <v-text-field v-model="docente.email">
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field v-model="formDocente.email">
                                            </v-text-field>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>CARRERA QUE ATIENDE</p>
                                        <template v-if="docente != null">
                                            <v-select
                                                :items="carrera"
                                                item-title="nameCarrera"
                                                item-value="id"
                                                v-model="docente.carrera_id"
                                            >
                                            </v-select>
                                            <v-row justify="end" class="mr-1">
                                                <v-tooltip
                                                    location="right"
                                                >
                                                    <template v-slot:activator="{ props }">
                                                        <v-btn
                                                            icon
                                                            v-bind="props"
                                                            size="small"
                                                        >
                                                            <v-icon color="blue-lighten-1">
                                                                mdi-help
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Es la carrera en la que se tiene mas horas asginadas frente al grupo</span>
                                                </v-tooltip>
                                            </v-row>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-select
                                                :items="carrera"
                                                item-title="nameCarrera"
                                                item-value="id"
                                                v-model="formDocente.carrera_id"
                                            >
                                            </v-select>
                                            <v-row justify="end" class="mr-1">
                                                <v-tooltip
                                                    location="right"
                                                >
                                                    <template v-slot:activator="{ props }">
                                                        <v-btn
                                                            icon
                                                            v-bind="props"
                                                            size="small"
                                                        >
                                                            <v-icon color="blue-lighten-1">
                                                                mdi-help
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Es la carrera en la que se tiene mas horas asginadas frente al grupo</span>
                                                </v-tooltip>
                                            </v-row>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>DEPARTAMENTO AL QUE PERTENECE:</p>
                                        <template v-if="docente != null">
                                            <v-select
                                                :items="departamento"
                                                item-title="nameDepartamento"
                                                item-value="id"
                                                v-model="docente.departamento_id"
                                            >
                                            </v-select>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-select
                                                :items="departamento"
                                                item-title="nameDepartamento"
                                                item-value="id"
                                                v-model="formDocente.departamento_id"
                                            >
                                            </v-select>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>TIPO DE PLAZA:</p>
                                        <template v-if="docente != null">
                                            <v-select
                                                :items="plaza"
                                                item-title="nombre"
                                                item-value="id"
                                                v-model="docente.tipo_plaza"
                                            >
                                            </v-select>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-select
                                                :items="plaza"
                                                item-title="nombre"
                                                item-value="ID"
                                                v-model="formDocente.tipo_plaza"
                                            >
                                            </v-select>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>PUESTO:</p>
                                        <template v-if="docente != null">
                                            <v-select
                                                :items="puesto"
                                                item-title="nombre"
                                                item-value="id"
                                                v-model="docente.id_puesto"
                                            >
                                            </v-select>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-select
                                                :items="puesto"
                                                item-title="nombre"
                                                item-value="id"
                                                v-model="formDocente.id_puesto"
                                            >
                                            </v-select>
                                        </template>
                                    </v-col>
                                    <v-col cols="6">
                                        <p>Telefono fijo:</p>
                                        <template v-if="docente != null">
                                            <v-text-field v-model="docente.telefono">
                                            </v-text-field>
                                        </template>
                                        <template v-if="docente === null">
                                            <v-text-field v-model="formDocente.telefono">
                                            </v-text-field>
                                        </template>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <v-divider></v-divider>
                            <v-container class="mx-auto">
                                <v-row align="end" justify="end">
                                    <v-col cols="2">
                                        <v-btn
                                            color="light-blue-darken-1"
                                            type="submit"
                                        >
                                            ACTUALIZAR
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-form>
                    </v-sheet>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>

<script setup>
import {computed, ref} from "vue";
import { usePage, Link, router } from "@inertiajs/vue3";

const user = computed(() => usePage().props.user[0]);
const docente = computed(() => usePage().props.docente);
const carrera = computed(() => usePage().props.carrera);
const departamento = computed(() => usePage().props.departamento);
const plaza = computed(() => usePage().props.tipo_plaza);
const puesto = computed(() => usePage().props.puesto);
const formDocente = ref({
    id: user.value.id,
    rfc: "",
    curp: "",
    nombre: "",
    apellidoPat: "",
    apellidoMat: "",
    sexo: null,
    email: user.value.email,
    telefono: "",
    carrera_id: null,
    id_puesto: null,
    tipo_plaza: null,
    departamento_id: user.value.departamento_id,
});

const sex = [{value: 1, text: "M"}, {value: 2, text: "F"}]

function submit() {
    if (docente.value === null){
        router.post('/docentes/guardar', formDocente.value);
    }else if(docente.value != null){
        router.put('/docentes/guardar' + '/' + docente.value.id, docente.value);
    }
}
</script>

<style scoped>
h1 {
    margin-left: 50px;
}
</style>
