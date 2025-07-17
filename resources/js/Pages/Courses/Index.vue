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
            <div v-if="['admin','author'].includes($page.props.auth.user.role)" class="mb-4">
                <Link :href="route('courses.create')" class="text-blue-600">Create Course</Link>
            </div>
            <ul>
                <li v-for="course in courses" :key="course.id">
                    <Link :href="route('courses.show', course.id)" class="text-blue-600">{{ course.title }}</Link>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
