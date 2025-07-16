<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ course: Object });
</script>

<template>
    <Head :title="course.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ course.title }}</h2>
        </template>
        <div class="py-6">
            <p class="mb-4">{{ course.description }}</p>
            <div>
                <h3 class="font-bold mb-2">Lessons</h3>
                <ul>
                    <li v-for="lesson in course.lessons" :key="lesson.id">
                        <Link :href="route('lessons.show', lesson.id)" class="text-blue-600">{{ lesson.title }}</Link>
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
