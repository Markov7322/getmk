<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ courses: Array });
</script>

<template>
    <Head title="Courses" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Courses</h2>
        </template>
        <div class="py-6">
            <div v-for="course in courses" :key="course.id" class="mb-4">
                <Link :href="route('courses.show', course.id)" class="text-blue-600">{{ course.title }}</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
