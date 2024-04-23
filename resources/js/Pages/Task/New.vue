<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    due_date: '',
    priority: '',

});

const submit = () => form.post(route('task.store'))

</script>

<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-white rounded-md shadow-sm">
                <div class="p-4">
                    <form @submit.prevent="submit">
                        <div class="mt-2">
                            <InputLabel for="title" value="Title" />

                            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div class="mt-2">
                            <InputLabel for="description" value="Description" />

                            <textarea id="description" type="description" v-model="form.description"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>

                        </div>
                        <div class="mt-2">
                            <InputLabel for="due_date" value="Due Date" />

                            <input type="date" name="due_date" id="due_date" v-model="form.due_date"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required />

                            <InputError class="mt-2" :message="form.errors.due_date" />
                        </div>
                        <div class="mt-2">
                            <InputLabel for="priority" value="Priority" />

                            <select name="priority" id="priority" v-model="form.priority" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.priority" />
                        </div>

                        <PrimaryButton class="mt-2" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
