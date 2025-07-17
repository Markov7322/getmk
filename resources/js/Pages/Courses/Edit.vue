<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ course: Object });

const form = useForm({
    title: course.title,
    description: course.description
});

function submit() {
    form.put(route('courses.update', course.id));
}
</script>

<template>
    <Head :title="`Edit ${course.title}`" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Course</h2>
        </template>
        <div class="max-w-xl mx-auto py-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea v-model="form.description" class="mt-1 w-full rounded border-gray-300"></textarea>
                </div>
                <button type="submit" class="rounded bg-blue-600 text-white px-4 py-2">Save</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
