<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ module: Object });
const form = useForm({
    title: props.module.title,
});

function submit() {
    form.put(route('modules.update', props.module.id));
}
</script>

<template>
    <Head :title="'Edit ' + props.module.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Module</h2>
        </template>
        <div class="mx-auto max-w-md py-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
