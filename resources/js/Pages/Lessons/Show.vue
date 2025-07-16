<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ lesson: Object });
</script>

<template>
    <Head :title="lesson.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ lesson.title }}</h2>
        </template>
        <div class="py-6 space-y-4">
            <p v-if="lesson.content" v-html="lesson.content" />
            <video v-if="lesson.video_url" controls :src="lesson.video_url" class="w-full" />
        </div>
    </AuthenticatedLayout>
</template>
