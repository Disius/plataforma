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
                        <v-container>
                            <v-row justify="center">
                                <template v-if="props.docente != null">
                                    <v-col cols="4">
                                        <p>Nombre(s)</p>
                                        {{props.docente.nombre}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>Apellido paterno</p>
                                        {{props.docente.apellidoPat}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>Apellido materno</p>
                                        {{props.docente.apellidoMat}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>RFC</p>
                                        {{props.docente.rfc}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>CURP</p>
                                        {{props.docente.curp}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>CARRERA</p>
                                        {{props.docente.nameCarrera}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>PUESTO</p>
                                        {{props.docente.namePuesto}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>PLAZA</p>
                                        {{props.docente.namePlaza}}
                                    </v-col>
                                    <v-col cols="4">
                                        <p>DEPARTAMENTO ADSCRITO</p>
                                        {{props.docente.nameDepartamento}}
                                    </v-col>
                                </template>
                                <v-divider></v-divider>
                                <v-col cols="12">
                                    <template v-if="props.docente === null">
                                        <v-alert
                                            type="info"
                                            title="Atención"
                                            text='Si es la primera vez que te registras tendras que actualizar tu información'
                                            variant="tonal"
                                            :model-value="alertFirstTime"
                                        ></v-alert>
                                    </template>
                                </v-col>



                                <template v-if="props.docente === null">
                                    <v-col cols="12">
                                        <v-btn block prepend-icon="mdi-pencil" color="light-blue-darken-1" @click="nuevo = !nuevo">
                                            Editar Información
                                        </v-btn>
                                    </v-col>
                                </template>
                                <template v-if="props.docente != null">
                                    <v-col cols="12">
                                        <v-btn block prepend-icon="mdi-pencil" color="light-blue-darken-1" @click="edit = !edit">
                                            Editar Información
                                        </v-btn>
                                    </v-col>
                                </template>



                            <template v-if="nuevo === true">
                                <v-form @submit.prevent="submitNewDocente">
                                    <v-container class="mx-auto">
                                        <v-row justify="center">
                                            <v-col align-self="center" cols="12">
                                                <v-alert
                                                    type="info"
                                                    title="Atención"
                                                    text='Nombres como apellidos deben comenzar con MAYÚSCULAS y seguido de MINUSCULAS'
                                                    variant="tonal"
                                                    :model-value="alert"
                                                ></v-alert>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>NOMBRE(S):</p>
                                                <v-text-field label="" v-model="formDocente.nombre"> </v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>APELLIDO PATERNO:</p>
                                                <v-text-field label="" v-model="formDocente.apellidoPat"> </v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>APELLIDO MATERNO:</p>
                                                <v-text-field
                                                    label=""
                                                    v-model="formDocente.apellidoMat"
                                                >
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>SEXO:</p>
                                                <v-select v-model="formDocente.sexo" :items="sex" item-title="text" item-value="value">

                                                </v-select>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>CURP:</p>
                                                <v-text-field v-model="formDocente.curp" :rules="CURPValidator">

                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>RFC:</p>
                                                <v-text-field v-model="formDocente.rfc" :rules="RFCValidator">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>CORREO INSTITUCIONAL:</p>
                                                <v-text-field v-model="formDocente.email" :disabled="!emailEdit">
                                                </v-text-field>
                                                <v-row justify="start" class="ml-3">
                                                    <v-tooltip
                                                        location="right"
                                                    >
                                                        <template v-slot:activator="{ props }">
                                                            <v-btn
                                                                icon
                                                                v-bind="props"
                                                                size="small"
                                                                @click=""
                                                            >
                                                                <v-icon color="blue-lighten-1">
                                                                    mdi-help
                                                                </v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <template v-if="user.role === 1 || user.role === 2 || user.role === 3">
                                                            <span>Tu correo institucional pertenece a una jefatura o coordinación</span>
                                                        </template>
                                                    </v-tooltip>
                                                </v-row>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>CARRERA QUE ATIENDE</p>
                                                <v-select
                                                    :items="props.carrera"
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
                                            </v-col>
                                            <v-col cols="6">
                                                <p>DEPARTAMENTO AL QUE PERTENECE:</p>
                                                <v-select
                                                    :items="props.departamento"
                                                    item-title="nameDepartamento"
                                                    item-value="id"
                                                    v-model="formDocente.departamento_id"
                                                >
                                                </v-select>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>TIPO DE PLAZA:</p>
                                                <v-select
                                                    :items="props.tipo_plaza"
                                                    item-title="nombre"
                                                    item-value="id"
                                                    v-model="formDocente.tipo_plaza"
                                                >
                                                </v-select>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>PUESTO:</p>
                                                <v-select
                                                    :items="props.puesto"
                                                    item-title="nombre"
                                                    item-value="id"
                                                    v-model="formDocente.id_puesto"
                                                >
                                                </v-select>
                                            </v-col>
                                            <v-col cols="6">
                                                <p>TELEFONO FIJO:</p>
                                                <v-text-field v-model="formDocente.telefono" maxlength="12">

                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                    <v-divider></v-divider>
                                    <v-container class="mx-auto">
                                        <v-row align="center" justify="center">
                                            <v-col cols="6">
                                                <v-btn
                                                    color="light-blue-darken-1"
                                                    type="submit" block size="x-large"
                                                >
                                                    ACTUALIZAR
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-form>
                            </template>
                                <template v-if="edit === true">
                                    <v-form @submit.prevent="submitEditDocente">
                                        <v-container class="mx-auto">
                                            <v-row justify="center">
                                                <v-col align-self="center" cols="12">
                                                    <v-alert
                                                        type="info"
                                                        title="Atención"
                                                        text='Nombres como apellidos deben comenzar con MAYÚSCULAS y seguido de MINUSCULAS'
                                                        variant="tonal"
                                                        :model-value="alert"
                                                    ></v-alert>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>NOMBRE(S):</p>
                                                    <v-text-field label="" v-model="props.docente.nombre"> </v-text-field>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>APELLIDO PATERNO:</p>
                                                    <v-text-field label="" v-model="props.docente.apellidoPat"> </v-text-field>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>APELLIDO MATERNO:</p>
                                                    <v-text-field
                                                        label=""
                                                        v-model="props.docente.apellidoMat"
                                                    >
                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>SEXO:</p>
                                                    <v-select v-model="props.docente.sexo" :items="sex" item-title="text" item-value="value">

                                                    </v-select>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>CURP:</p>
                                                    <v-text-field v-model="props.docente.curp" :rules="CURPValidator">

                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>RFC:</p>
                                                    <v-text-field v-model="props.docente.rfc" :rules="RFCValidator">
                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>CORREO INSTITUCIONAL:</p>
                                                    <v-text-field v-model="props.docente.email" :disabled="!emailEdit">
                                                    </v-text-field>
                                                    <v-row justify="start" class="ml-3">
                                                        <v-tooltip
                                                            location="right"
                                                        >
                                                            <template v-slot:activator="{ props }">
                                                                <v-btn
                                                                    icon
                                                                    v-bind="props"
                                                                    size="small"
                                                                    @click="emailEdit = true"
                                                                >
                                                                    <v-icon color="blue-lighten-1">
                                                                        mdi-help
                                                                    </v-icon>
                                                                </v-btn>
                                                            </template>
                                                            <span>Puesto que te has registrado no es necesario actualizar tu email, pero presiona el botón si asi lo deseas</span>
                                                        </v-tooltip>
                                                    </v-row>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>CARRERA QUE ATIENDE</p>
                                                    <v-select
                                                        :items="props.carrera"
                                                        item-title="nameCarrera"
                                                        item-value="id"
                                                        v-model="props.docente.carrera_id"
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
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>DEPARTAMENTO AL QUE PERTENECE:</p>
                                                    <v-select
                                                        :items="props.departamento"
                                                        item-title="nameDepartamento"
                                                        item-value="id"
                                                        v-model="props.docente.departamento_id"
                                                    >
                                                    </v-select>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>TIPO DE PLAZA:</p>
                                                    <v-select
                                                        :items="props.tipo_plaza"
                                                        item-title="nombre"
                                                        item-value="id"
                                                        v-model="props.docente.tipo_plaza"
                                                    >
                                                    </v-select>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>PUESTO:</p>
                                                    <v-select
                                                        :items="props.puesto"
                                                        item-title="nombre"
                                                        item-value="id"
                                                        v-model="props.docente.id_puesto"
                                                    >
                                                    </v-select>
                                                </v-col>
                                                <v-col cols="6">
                                                    <p>TELEFONO FIJO:</p>
                                                    <v-text-field v-model="props.docente.telefono" maxlength="10">

                                                    </v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                        <v-divider></v-divider>
                                        <v-container class="mx-auto">
                                            <v-row align="center" justify="center">
                                                <v-col cols="6">
                                                    <v-btn
                                                        color="light-blue-darken-1"
                                                        type="submit" block size="x-large" :disabled="formDocente.processing"
                                                    >
                                                        ACTUALIZAR
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-form>
                                </template>
                            </v-row>
                        </v-container>
                    </v-sheet>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import {Link, useForm, usePage} from "@inertiajs/vue3";

const props = defineProps({
    puesto: null,
    departamento: null,
    carrera: null,
    tipo_plaza: null,
    docente: null
});
const CURPValidator = [
    value => {
        if (value?.length <= 18 && /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/.test(value)) return true

        return "La CURP no es correcta"
    }
]
const RFCValidator = [
    value => {
        if (value?.length <= 13 && /^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$/.test(value)) return true

        return "El RFC es incorrecto"
    }
]
 //const counter = [value => value.length <= 10 || 'Max 10 characters']
let emailEdit = ref(false);
const edit = ref(false);
const nuevo = ref(false);
let alert = ref(true)
let alertFirstTime = ref(true)
const user = computed(() => usePage().props.user[0]);
const formDocente = useForm({
    id: user.value.id,
    rfc: "",
    curp: "",
    nombre: "",
    apellidoPat: "",
    apellidoMat: "",
    sexo: null,
    email: null,
    telefono: "",
    carrera_id: null,
    id_puesto: null,
    tipo_plaza: null,
    departamento_id: null,
})


const sex = [{value: 1, text: "M"}, {value: 2, text: "F"}]

function submitNewDocente(){
    nuevo.value = false
    return formDocente.post('/docentes/guardar')
}

function submitEditDocente(){
    edit.value = false;
    formDocente.nombre = props.docente.nombre;
    formDocente.apellidoPat = props.docente.apellidoPat;
    formDocente.apellidoMat = props.docente.apellidoMat;
    formDocente.curp = props.docente.curp;
    formDocente.rfc = props.docente.rfc;
    formDocente.sexo = props.docente.sexo;
    formDocente.email = props.docente.email;
    formDocente.carrera_id = props.docente.carrera_id;
    formDocente.id_puesto = props.docente.id_puesto;
    formDocente.tipo_plaza = props.docente.tipo_plaza;
    formDocente.departamento_id = props.docente.departamento_id;
    return formDocente.put('/docentes/editar' + '/' + props.docente.id)
}

onMounted(() => {
    setTimeout(() => {
        alert.value = false
    }, 20000)
    setTimeout(() => {
        alertFirstTime.value = false
    }, 20000)
})
</script>

<style scoped>

</style>
