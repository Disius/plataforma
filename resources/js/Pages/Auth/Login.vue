<template>
    <v-app>
        <v-container class="mt-10 pt-10">
            <v-row justify="center"  align="center" class="mt-10 pt-10">
                <v-card width="400" height="500" elevation="5">
                    <v-card-title class="text-center">Iniciar Sesión</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-text>
                        <v-form fast-fail @submit.prevent="form.post('/login')">
                            <v-row justify="center">
                                <v-col cols="10" class="mt-8">
                                    <v-text-field label="Email" variant="solo" clearable v-model="form.email"></v-text-field>
                                </v-col>
                                <v-col cols="10" class="mt-8">
                                    <v-text-field type="password" label="Contraseña" variant="solo" clearable v-model="form.password"></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row justify="end">
                                <v-col cols="4">
                                    <v-btn icon="mdi-login" size="x-large" type="submit">

                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-card-text>
                    <v-spacer></v-spacer>
                    <v-card-actions>
                        <v-row justify="center">
                            <v-col cols="5">
                                <Link as="button" type="button" href="/register" :data="{role: props.role}">
                                    <v-btn block type="button">
                                        Registrarse
                                    </v-btn>
                                </Link>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                </v-card>
            </v-row>
        </v-container>
    </v-app>
</template>

<script setup>
import {useForm, Link} from "@inertiajs/vue3";
import {ref} from "vue";
const form = useForm({
    email: null,
    password: null,
});

const props = defineProps({
    role: null
})


</script>

<style scoped>

</style>
