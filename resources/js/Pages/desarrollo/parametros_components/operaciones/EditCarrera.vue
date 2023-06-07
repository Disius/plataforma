<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {onMounted} from "vue";
    const props = defineProps({
        c: Object,
        dialogEdit: Boolean,

    });

const form = useForm({
    nameCarrera: "",
    jefe_departamento: Number,
    presidente_academia: Number,
    departamento_id: Number,
});

onMounted(() => {
    form.nameCarrera = props.c.nameCarrera
    form.jefe_departamento = props.c.jefe_departamento
    form.presidente_academia = props.c.presidente_academia
    form.departamento_id = props.c.departamento_id
})
</script>
<template>
    <v-dialog v-model="props.dialogEdit" width="auto">
        <v-card height="400" width="400">
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field v-model="form.nameCarrera"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field v-model="form.jefe_departamento"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field v-model="form.presidente_academia"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field v-model="form.departamento_id"></v-text-field>
                    </v-col>
                </v-row>
            </v-container>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn @click="$emit('closeEvent', false)">
                    Cerrar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped>

</style>
