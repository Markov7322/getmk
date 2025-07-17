<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ course: Object });
</script>

<template>
    <Head :title="course.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ course.title }}</h2>
        </template>
        <div class="py-6 space-y-4">
            <p>{{ course.description }}</p>
            <div>
                <h3 class="font-bold mb-2">Modules</h3>
                <ul>
                    <li v-for="module in course.modules" :key="module.id">
                        <Link :href="route('modules.show', module.id)" class="text-blue-600">{{ module.title }}</Link>
                    </li>
                </ul>
                <div v-if="['admin','author'].includes($page.props.auth.user.role)">
                    <Link :href="route('modules.create', { course: course.id })" class="text-blue-600">Add Module</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
