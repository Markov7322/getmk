<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    course_id: '',
    title: '',
});

function submit() {
    form.post(route('modules.store'));
}
</script>

<template>
    <Head title="Create Module" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Module
            </h2>
        </template>
        <div class="mx-auto max-w-md py-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course ID</label>
                    <input v-model="form.course_id" type="number" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Create</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
