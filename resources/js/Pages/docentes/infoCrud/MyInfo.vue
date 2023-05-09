<template>
    <v-layout class="" style="height: 50px">
        <v-app-bar color="blue-lighten-1">
            <Link href="/dashboard" type="button" as="button">
                <v-btn type="button" size="x-large" icon="mdi-arrow-left">

                </v-btn>
            </Link>

            <v-app-bar-title class="text-center ml-0 text-h5">{{user.email}}</v-app-bar-title>
        </v-app-bar>
    </v-layout>

    <v-container class="mx-auto">
        <v-row justify="center" class="mt-4">
            <v-sheet :width="4000" elevation="8">
                <h1>Información personal</h1>
                <v-divider></v-divider>
                <v-form @submit.prevent="submit">
                    <v-container class="mx-auto">
                        <v-row justify="center">
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
                                    <v-text-field v-model="docente.sexo">
                                    </v-text-field>
                                </template>
                                <template v-if="docente === null">
                                    <v-text-field v-model="formDocente.sexo">

                                    </v-text-field>
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
                                <p>EMAIL:</p>
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
                                <p>CARRERA A LA QUE PERTENECE:</p>
                                <template v-if="docente != null">
                                    <v-select
                                        :items="carrera"
                                        item-title="nameCarrera"
                                        item-value="id"
                                        v-model="docente.carrera_id"
                                    >
                                    </v-select>
                                </template>
                                <template v-if="docente === null">
                                    <v-select
                                        :items="carrera"
                                        item-title="nameCarrera"
                                        item-value="id"
                                        v-model="formDocente.carrera_id"
                                    >
                                    </v-select>
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
                                        item-value="ID"
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
    sexo: "",
    email: user.value.email,
    telefono: "",
    carrera_id: null,
    id_puesto: null,
    tipo_plaza: null,
    departamento_id: user.value.departamento_id,
})
function submit() {
    if (docente.value === null){
        router.post('/docentes/guardar', formDocente.value);
    }else if(docente.value != null){
        return "Aca se actualiza"
    }
}
</script>

<style scoped>
h1 {
    margin-left: 50px;
}
</style>
