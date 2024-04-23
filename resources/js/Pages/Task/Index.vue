<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { props } = usePage();
const search = ref(props.filters.search || '');
const form = useForm({ search: search.value });


function handleSearch() {
    form.search = search.value;
    form.get(route('task.list'), { preserveState: true });
}

defineProps({
    tasks: Object,
    total: Number
});




</script>


<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- This is an example component -->

                <div class="flex justify-between items-center">
                    <Link :href="route('task.create')"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Add New
                    </Link>

                    <input v-model="search" @input="handleSearch"
                        class="mt-1 block w-[30%] border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        placeholder="Search Tasks...">
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-2">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Title</th>
                                    <th scope="col" class="py-3 px-6">Due Date</th>
                                    <th scope="col" class="py-3 px-6">Priority</th>
                                    <th scope="col" class="py-3 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in tasks.data" :key="task.id" class="bg-white border-b ">
                                    <td class="py-4 px-6">{{ task.title }}</td>
                                    <td class="py-4 px-6">{{ task.due_date }}</td>
                                    <td class="py-4 px-6" v-if="task.priority == 1">
                                        Low
                                    </td>
                                    <td class="py-4 px-6" v-if="task.priority == 2">
                                        Medium
                                    </td>
                                    <td class="py-4 px-6" v-if="task.priority == 3">
                                        High
                                    </td>
                                    <td class="py-4 px-1">
                                        <div class="flex justify-start items-center gap-2">
                                            <Link :href="route('task.edit', { id: task.id })"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Edit
                                            </Link>
                                            <Link :href="`/tasks/${task.id}/delete`"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Delete
                                            </Link>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <Pagination v-if="total > 10" :pagination="tasks" />

            </div>
        </div>
    </AuthenticatedLayout>
</template>