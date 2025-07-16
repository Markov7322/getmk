<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    price: '',
    modules: [
        { title: '', lessons: [{ title: '', content: '' }] },
    ],
});

function addModule() {
    form.modules.push({ title: '', lessons: [{ title: '', content: '' }] });
}

function removeModule(index) {
    form.modules.splice(index, 1);
}

function addLesson(moduleIndex) {
    form.modules[moduleIndex].lessons.push({ title: '', content: '' });
}

function removeLesson(moduleIndex, lessonIndex) {
    form.modules[moduleIndex].lessons.splice(lessonIndex, 1);
}

function submit() {
    form.post(route('courses.store'));
}
</script>

<template>
    <Head title="Create Course" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Course
            </h2>
        </template>
        <div class="mx-auto max-w-4xl py-6">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea v-model="form.description" class="mt-1 w-full rounded border-gray-300"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input v-model="form.price" type="number" min="0" step="0.01" class="mt-1 w-full rounded border-gray-300" />
                </div>

                <div v-for="(module, mIndex) in form.modules" :key="mIndex" class="rounded border p-4">
                    <div class="mb-2 flex justify-between">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Module Title</label>
                            <input v-model="module.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                        </div>
                        <button type="button" @click="removeModule(mIndex)" class="ml-2 text-sm text-red-500">Remove</button>
                    </div>

                    <div v-for="(lesson, lIndex) in module.lessons" :key="lIndex" class="mb-4">
                        <div class="flex justify-between">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700">Lesson Title</label>
                                <input v-model="lesson.title" type="text" class="mt-1 w-full rounded border-gray-300" />
                            </div>
                            <button type="button" @click="removeLesson(mIndex, lIndex)" class="ml-2 text-sm text-red-500">Remove</button>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea v-model="lesson.content" class="mt-1 w-full rounded border-gray-300"></textarea>
                        </div>
                    </div>

                    <button type="button" @click="addLesson(mIndex)" class="text-sm text-blue-600">Add Lesson</button>
                </div>

                <button type="button" @click="addModule" class="text-sm text-blue-600">Add Module</button>

                <div>
                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Create</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
