<script setup>
    const props = defineProps({
        carrera: Array,
    });
</script>
<template>
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
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="c in props.carrera"
            :key="c.id"

        >
            <td>{{c.nameCarrera}}</td>
        </tr>
        </tbody>
    </v-table>
</template>

<style scoped>

</style>
