<template>
    <v-card
        color="light-blue-darken-1"
        flat
        rounded="0"
        elevation="6"
    >
        <v-toolbar extended color="light-blue-darken-1">

            <v-toolbar-title class="text-h5">{{user[0].email}}</v-toolbar-title>

            <v-spacer></v-spacer>





            <Link as="button" type="button" href="/logout" method="post">
                <v-btn icon type="button">
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </Link>
        </v-toolbar>
    </v-card>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
const user = computed(() => usePage().props.user)
</script>

<style scoped>

</style>
