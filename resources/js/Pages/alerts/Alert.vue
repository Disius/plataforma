<script setup>
const props = defineProps({
    messegue: Object,
})
</script>
<template>
    <v-alert closable type="error">
            <div v-for="mensaje in messegue" :key="mensaje">
                        {{mensaje}}
            </div>
    </v-alert>
</template>

<style scoped>

</style>
