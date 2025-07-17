<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ lesson: Object });
</script>

<template>
    <Head :title="lesson.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ lesson.title }}</h2>
        </template>
        <div class="py-6">
            <p>{{ lesson.content }}</p>
        </div>
    </AuthenticatedLayout>
</template>
