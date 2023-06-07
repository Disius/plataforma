<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {onMounted, ref, watch} from "vue";

const props = defineProps({
        carrera: Array,
        departamento: Array,
});

let itemSelected = ref({});
const dialog = ref(false);

function getRow(item){
    itemSelected.value = item
    dialog.value = true
}
const form = useForm({
    nameCarrera: "",
    jefe_departamento: Number,
    presidente_academia: Number,
    departamento_id: Number,
});

function editCarrera(){
    form.nameCarrera = itemSelected.value.nameCarrera
    form.jefe_departamento = itemSelected.value.jefe_departamento
    form.presidente_academia = itemSelected.value.presidente_academia
    form.departamento_id = itemSelected.value.departamento_id
    form.put('/desarrollo/carrera-editada' + '/' + itemSelected.value.id)
}
onMounted(() => {

})
</script>
<template>
    <v-card width="1000px">
        <v-table
            fixed-header
            height="300px"
            hover
        >
            <thead>
            <tr>
                <th>Carrera</th>
                <th>Departamento a cargo</th>
                <th>Jefe del departamento</th>
                <th>Presidente de la academia</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="c in props.carrera"
                :key="c.id"
                :class="{ itemSelected: c === itemSelected }"
            >
                <td>{{c.nameCarrera}}</td>
                <template v-if="c.id !== 11">
                    <td>
                        <v-btn @click="getRow(c)">

                        </v-btn>
                    </td>
                </template>
            </tr>
            </tbody>
        </v-table>
    </v-card>


    <v-dialog v-model="dialog" width="auto">
        <v-card height="500" width="600">
            <v-form @submit.prevent="editCarrera">
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field v-model="itemSelected.nameCarrera"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="itemSelected.jefe_departamento"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="itemSelected.presidente_academia"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-select :items="props.departamento" item-title="nameDepartamento" item-value="id" v-model="itemSelected.departamento_id"></v-select>
                        </v-col>
                    </v-row>
                </v-container>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-row justify="end">
                        <v-col align-self="center" cols="3">
                            <v-btn @click="dialog = !dialog" color="red" size="large">
                                Cerrar
                            </v-btn>
                        </v-col>
                        <v-col align-self="center" cols="3">
                            <v-btn type="submit" color="blue" size="large">
                                Editar
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped>
. itemSelected {
    background-color: red;
}
</style>
