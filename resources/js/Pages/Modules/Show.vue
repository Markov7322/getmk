<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ module: Object });
</script>

<template>
    <Head :title="module.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ module.title }}</h2>
        </template>
        <div class="py-6 space-y-4">
            <div>
                <h3 class="font-bold mb-2">Lessons</h3>
                <ul>
                    <li v-for="lesson in module.lessons" :key="lesson.id">
                        <Link :href="route('lessons.show', lesson.id)" class="text-blue-600">{{ lesson.title }}</Link>
                    </li>
                </ul>
                <div v-if="['admin','author'].includes($page.props.auth.user.role)">
                    <Link :href="route('lessons.create', { module: module.id })" class="text-blue-600">Add Lesson</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
