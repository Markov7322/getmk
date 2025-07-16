<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ module: Object });
</script>

<template>
    <Head :title="module.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ module.title }}</h2>
        </template>
        <div class="py-6">
            <h3 class="font-bold mb-2">Lessons</h3>
            <ul>
                <li v-for="lesson in module.lessons" :key="lesson.id">
                    <Link :href="route('lessons.show', lesson.id)" class="text-blue-600">{{ lesson.title }}</Link>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
