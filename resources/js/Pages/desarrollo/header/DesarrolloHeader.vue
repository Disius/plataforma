<script setup>
import {ref} from 'vue';
import {Link} from '@inertiajs/vue3'
const drawer = ref(true);
const props = defineProps({
    usuario: Array,
    n2: Array
});


</script>
<template>
<v-navigation-drawer v-model="drawer" color="light-blue-darken-4">
            <v-list>
                <v-list-item

                >
                                    {{props.usuario[0].email}}
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list color="transparent">
                <Link href="/dashboard" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Inicio"></v-list-item>
                </Link>

                <Link href="/desarrollo/coordinacion/cursos" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Cursos"></v-list-item>
                </Link>
                <Link href="/desarrollo/coordinacion/deteccion" as="v-list-item">
                    <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                </Link>
                <template v-if="props.usuario[0].role === 1">
                    <Link href="/desarrollo/parametros" as="v-list-item">
                        <v-list-item link prepend-icon="" title="Deteccion de Necesidades"></v-list-item>
                    </Link>
                </template>
                <Link href="/docentes/mis-datos" as="v-list-item">
                     <v-list-item link prepend-icon="" title="Mi información"></v-list-item>
                </Link>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <Link href="/logout" as="v-btn" method="post">
                        <v-btn block color="light-blue-darken-1">
                            Cerrar Sesión
                        </v-btn>
                    </Link>
                </div>
            </template>
        </v-navigation-drawer>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-app-bar class="">
            <v-icon size="x-large" class="ml-4" @click="drawer = !drawer">mdi-menu</v-icon>
            <v-spacer></v-spacer>
                <v-menu class="" location="start">
                    <template v-slot:activator="{ props }">
                        <v-btn stacked size="x-large"  v-bind="props" class="mr-6 pr-6">
                            <v-badge
                                :content="n2.length"
                                color="error"
                            >
                                <v-icon icon="mdi-bell"></v-icon>
                            </v-badge>
                        </v-btn>
                    </template>
                    <v-list>
                        <template v-if="n2.length > 0">
                            <v-list-item
                                v-for="(item, index) in n2"
                                :key="item"
                                prepend-icon="mdi-account-details"
                            >
                                <v-list-item-title>{{ item.data.email }} a creado una nueva Deteccion de necesidades</v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-action>
                                    <v-row justify="end">
                                        <v-col cols="7 ">
                                            <Link method="post" :href="'/desarrollo/notification/read' + '/' + n2[0].notifiable_id" as="v-btn" type="v-btn">
                                                <v-btn>
                                                    Ir a Deteccion de Necesidades
                                                </v-btn>
                                            </Link>
                                        </v-col>
                                    </v-row>
                                </v-list-item-action>
                            </v-list-item>
                        </template>
                        <template v-else>
                            <v-list-item

                            >
                            <v-list-item-title>Sin notificaciones recientes</v-list-item-title>

                            </v-list-item>
                        </template>
                    </v-list>
                </v-menu>
        </v-app-bar>
</template>

<style>
</style>
