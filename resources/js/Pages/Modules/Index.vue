<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ modules: Array });
</script>

<template>
    <Head title="Modules" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Modules</h2>
        </template>
        <div class="py-6">
            <div v-for="module in modules" :key="module.id" class="mb-4">
                <Link :href="route('modules.show', module.id)" class="text-blue-600">{{ module.title }}</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
