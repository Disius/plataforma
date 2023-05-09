<template>
    <template v-if="props.role == 4">
        <v-row justify="center" class="mt-4 pt-4">
            <v-col cols="12" sm="6">
                <v-alert
                    type="info"
                    title="Docente!!"
                    text="Buscar en el campo de 'Docente' para verificar si se encuentra registrado en la base de datos.
                            De asi serlo, solo crear una contraseña, de lo contrario ingresar EMAIL, CONTRASEÑA Y NOMBRE
                    "
                ></v-alert>
            </v-col>
        </v-row>
    </template>

    <v-container>
        <v-row justify="center" class="mt-5 pt-5">
            <v-form ref="form" @submit.prevent="formRegistro.post('/register')">
                <v-card width="900" height="700" elevation="9">
                    <v-card-title class="text-center">Registrarse</v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row justify="center">
                                <v-col cols="8">
                                    <label>Docente</label>
                                    <v-autocomplete
                                        :items="docentes"
                                        item-title="nombre_completo"
                                        item-value="id"
                                        v-model="formRegistro.id_docente"
                                    >
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                        v-model="formRegistro.email"
                                        clearable
                                        variant="solo"
                                        label="Correo Electronico"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                        v-model="formRegistro.password"
                                        clearable
                                        variant="solo"
                                        label="Contraseña"
                                        type="password"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                        v-model="formRegistro.name"
                                        clearable
                                        variant="solo"
                                        label="Nombre"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                    <v-select
                                        v-model="formRegistro.departamento_id"
                                        clearable
                                        variant="solo"
                                        label="Departamento al que pertenece"
                                        :items="props.departamento"
                                        item-title="nameDepartamento"
                                        item-value="id"
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-row justify="end">
                            <v-col cols="5">
                                <v-btn
                                    prepend-icon="mdi-account-plus"
                                    block
                                    color="light-blue-darken-1"
                                    type="submit"
                                >
                                    Registrarse
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-row>
    </v-container>
</template>

<script setup>
import { computed, ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

let docentes = computed(() => usePage().props.docentes);
const props = defineProps({
    role: null,
    departamento: null,
});
const form = ref();
const formRegistro = useForm({
    id_docente: null,
    email: "",
    password: "",
    roleUser: props.role,
    name: "",
    departamento_id: null,
});

console.log(props.departamento);
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
