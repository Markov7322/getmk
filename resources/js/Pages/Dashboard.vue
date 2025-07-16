<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ courses: Array });
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
                <div v-if="['author','admin'].includes($page.props.auth.user.role)">
                    <h3 class="mb-2 text-lg font-semibold">My Courses</h3>
                    <div v-for="course in courses" :key="course.id" class="mb-1">
                        <Link :href="route('courses.show', course.id)" class="text-blue-600">{{ course.title }}</Link>
                    </div>
                    <Link :href="route('courses.create')" class="mt-2 inline-block text-blue-600">Create new course</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
