<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    module_id: '',
    title: '',
    content: '',
    video_url: '',
    position: '',
});

function submit() {
    form.post(route('lessons.store'));
}
</script>

<template>
    <Head title="Create Lesson" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create Lesson</h2>
        </template>
        <div class="mx-auto max-w-md py-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Module ID</label>
                    <input v-model="form.module_id" type="number" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea v-model="form.content" class="mt-1 w-full rounded border-gray-300"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Video URL</label>
                    <input v-model="form.video_url" type="text" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Position</label>
                    <input v-model="form.position" type="number" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Create</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
